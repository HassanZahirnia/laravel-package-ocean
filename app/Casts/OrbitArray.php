<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class OrbitArray implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (is_null($value)) {
            return [];
        }

        // If it's already an array, return it
        if (is_array($value)) {
            return $value;
        }

        // If it's a JSON string, decode it
        if (is_string($value)) {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        // Always return JSON string for Orbit to save
        if (is_null($value)) {
            return json_encode([]);
        }

        if (is_array($value)) {
            return json_encode($value);
        }

        if (is_string($value)) {
            // If it's already a JSON string, validate and return
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $value;
            }
        }

        return json_encode([]);
    }
}
