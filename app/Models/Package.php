<?php

namespace App\Models;

use Composer\Semver\Constraint\Constraint;
use Composer\Semver\Constraint\ConstraintInterface;
use Composer\Semver\Constraint\MultiConstraint;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use NumberFormatter;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;
use Orbit\Drivers\Yaml;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Package extends Model implements Feedable, Orbit
{
    use HasFactory;
    use Orbital;

    protected $casts = [
        'keywords' => 'array',
        'laravel_dependency_versions' => 'array',
        'paid_integration' => 'boolean',
    ];

    protected $appends = [
        'is_official_laravel_package',
    ];

    protected $guarded = [];

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('name');
        $table->string('description');
        $table->string('category_id');
        $table->string('github')->unique();
        $table->string('author');
        $table->string('composer')->nullable()->unique();
        $table->string('npm')->nullable()->unique();
        $table->integer('stars');
        $table->json('keywords');
        $table->timestamp('first_release_at')->nullable();
        $table->timestamp('latest_release_at')->nullable();
        $table->json('laravel_dependency_versions');
        $table->string('package_type');
        $table->boolean('paid_integration')->default(false);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function isOfficialLaravelPackage(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->author === 'laravel',
        );
    }

    // Get package rank number by number of stars, and where the package_type is laravel-package
    public function getRankAttribute(): int
    {
        return Package::query()
            ->where('package_type', 'laravel-package')
            ->where('stars', '>', $this->stars)
            ->count() + 1;
    }

    // A function to format large numbers
    // Example: 2600 -> 2.6k
    public function getStarsFormatted(): string
    {
        $number = $this->stars;

        $formatter = new NumberFormatter('en_US', NumberFormatter::PADDING_POSITION);

        return $formatter->format($number);
    }

    public function isCompatibleWithLaravelActiveVersions(): bool
    {
        return isCompatibleWithLaravelActiveVersions($this->laravel_dependency_versions);
    }

    public function minimumCompatibleLaravelVersion(): string
    {
        $versionParser = new VersionParser;
        $lowestVersion = null;

        foreach ($this->laravel_dependency_versions as $versionConstraint) {
            $constraints = $versionParser->parseConstraints($versionConstraint);

            if ($constraints instanceof MultiConstraint) {
                foreach ($constraints->getConstraints() as $constraint) {
                    $this->processConstraint($constraint, $lowestVersion);
                }
            } elseif ($constraints instanceof Constraint) {
                $this->processConstraint($constraints, $lowestVersion);
            }
        }

        return $lowestVersion;
    }

    private function processConstraint(ConstraintInterface $constraint, ?string &$lowestVersion)
    {
        if ($constraint instanceof MultiConstraint) {
            // For MultiConstraint, recursively process each sub-constraint
            foreach ($constraint->getConstraints() as $subConstraint) {
                $this->processConstraint($subConstraint, $lowestVersion);
            }
        } elseif ($constraint instanceof Constraint) {
            // For a regular Constraint, get its version and process it
            $version = formatSemverVersion($constraint->getVersion());

            if (is_null($lowestVersion) || Semver::satisfies($version, '<'.$lowestVersion)) {
                $lowestVersion = $version;
            }
        }
    }

    public function maximumCompatibleLaravelVersion(): ?string
    {
        $activeVersions = fetchActiveLaravelVersions();

        // Sort the active versions in descending order to start from the highest
        rsort($activeVersions);

        foreach ($this->laravel_dependency_versions as $versionConstraint) {

            foreach ($activeVersions as $activeVersion) {
                $formattedVersion = formatSemverVersion($activeVersion);

                // Check if the active version satisfies the constraint
                if (Semver::satisfies($formattedVersion, $versionConstraint)) {
                    return $formattedVersion;
                }
            }
        }

        return null; // Or handle cases when no version satisfies the constraint
    }

    public function updateStars(): void
    {
        if (! empty($this->github)) {
            $this->update([
                'stars' => fetchGithubStars($this->github),
            ]);
        }
    }

    public function updateReleaseDatesAndDependencies(): void
    {
        if (! empty($this->composer)) {
            $packagistData = getPackagistData($this->composer);

            $this->update([
                'first_release_at' => $packagistData['first_release_at'],
                'latest_release_at' => $packagistData['latest_release_at'],
                'laravel_dependency_versions' => $packagistData['laravel_dependency_versions'],
            ]);
        } elseif (! empty($this->npm)) {
            $npmData = getNpmData($this->npm);

            $this->update([
                'first_release_at' => $npmData['first_release_at'],
                'latest_release_at' => $npmData['latest_release_at'],
            ]);
        }
    }

    public function getOrbitDriver(): string
    {
        return Yaml::class;
    }

    public function getAuthorAndNameFromGithub(): string
    {
        return extractRepoFromGithubUrl($this->github);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title((string) $this->name)
            ->summary((string) $this->description)
            ->updated($this->created_at)
            ->link((string) $this->github)
            ->authorName((string) $this->author);
    }

    public static function getFeedItems()
    {
        return Package::all();
    }
}
