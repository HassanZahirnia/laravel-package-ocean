<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Orbit\Concerns\Orbital;
use Orbit\Contracts\Orbit;
use Orbit\Drivers\Yaml;

class User extends Authenticatable implements Orbit
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Orbital;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
    }

    public function getOrbitDriver(): string
    {
        return Yaml::class;
    }
}
