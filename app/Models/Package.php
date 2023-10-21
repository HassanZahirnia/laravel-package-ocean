<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;

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
        $table->text('content')->nullable();
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
}
