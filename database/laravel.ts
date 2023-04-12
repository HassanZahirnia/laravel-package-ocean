import database from './json/laravel.json'
import type { LaravelDatabase } from '~/types/laravel'

export const active_laravel_versions = database.active_versions as LaravelDatabase['active_versions']