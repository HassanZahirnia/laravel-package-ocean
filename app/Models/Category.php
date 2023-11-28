<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Category extends Model implements Orbit
{
    use HasFactory;
    use Orbital;
    use QueryCacheable;

    public $timestamps = false;

    public $cacheFor = 3600 * 24; // In seconds

    protected static $flushCacheOnUpdate = true;

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('name')->unique();
        $table->string('activeClass')->unique();
        $table->text('content')->nullable();
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
