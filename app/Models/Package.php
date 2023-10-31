<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use NumberFormatter;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;
use Orbit\Drivers\Yaml;

class Package extends Model implements Orbit
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

    // Laravel active versions
    public function getLaravelActiveVersions(): array
    {
        return collect([
            '10.26.2',
        ])
            ->sort()
            ->toArray();
    }

    public function isCompatibleWithLaravelActiveVersions(): bool
    {
        return true;
    }

    public function minimumCompatibleLaravelVersion(): string
    {
        return '10.0';
    }

    public function maximumCompatibleLaravelVersion(): string
    {
        return '10.23';
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
}
