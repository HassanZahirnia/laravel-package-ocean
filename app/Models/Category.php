<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;

class Category extends Model implements Orbit
{
    use HasFactory;
    use Orbital;

    public $timestamps = false;

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('name')->unique();
        $table->string('activeClass')->unique();
        $table->text('content')->nullable();
    }

    public function getIncrementing()
    {
        return false;
    }
}
