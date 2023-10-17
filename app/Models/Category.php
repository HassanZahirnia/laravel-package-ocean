<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Category extends Model
{
    use HasFactory;
    use \Orbit\Concerns\Orbital;

    public static function schema(Blueprint $table)
    {
        $table->integer('order')->unique();
        $table->string('name')->unique();
        $table->string('activeClass')->unique();
    }
}
