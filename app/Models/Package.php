<?php

namespace App\Models;

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
        return true;
    }

    public function minimumCompatibleLaravelVersion(): string
    {
        $versionParser = new VersionParser();
        $lowestVersion = null;

        foreach ($this->laravel_dependency_versions as $versionConstraint) {
            $constraints = $versionParser->parseConstraints($versionConstraint);

            foreach ($constraints->getConstraints() as $constraint) {
                $version = $this->formatVersion($constraint->getVersion());

                if (is_null($lowestVersion) || Semver::satisfies($version, '<'.$lowestVersion)) {
                    $lowestVersion = $version;
                }
            }
        }

        return $lowestVersion;
    }

    public function maximumCompatibleLaravelVersion(): string
    {
        $activeVersions = fetchActiveLaravelVersions();

        // Sort the active versions in descending order to start from the highest
        rsort($activeVersions);

        foreach ($this->laravel_dependency_versions as $versionConstraint) {

            foreach ($activeVersions as $activeVersion) {
                $formattedVersion = $this->formatVersion($activeVersion);

                // Check if the active version satisfies the constraint
                if (Semver::satisfies($formattedVersion, $versionConstraint)) {
                    return $formattedVersion;
                }
            }
        }

        return null; // Or handle cases when no version satisfies the constraint
    }

    private function formatVersion($version)
    {
        // Remove -dev suffix
        $version = str_replace('-dev', '', $version);

        // Keep only the first three parts of the version
        $parts = explode('.', $version);
        if (count($parts) > 3) {
            $version = implode('.', array_slice($parts, 0, 3));
        }

        return $version;
    }

    public function getOrbitDriver(): string
    {
        return Yaml::class;
    }

    // Get author and name of repo from the github link
    // Example: https://github.com/spatie/once -> spatie/once
    public function getAuthorAndNameFromGithub(): string
    {
        // Use regular expression to match the GitHub URL pattern
        $pattern = '/https?:\/\/github\.com\/([^\/]+)\/([^\/]+)/i';

        // Execute the regular expression match
        if (preg_match($pattern, $this->github, $matches)) {
            // If a match is found, return the author and repo name in the desired format
            return $matches[1].'/'.$matches[2];
        }

        // Return null if no match is found
        return null;
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->name)
            ->summary($this->description)
            ->updated($this->created_at)
            ->link($this->github)
            ->authorName($this->author);
    }

    public static function getFeedItems()
    {
        return Package::all();
    }
}
