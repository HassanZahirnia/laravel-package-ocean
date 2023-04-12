import { existsSync, readFileSync, writeFileSync } from 'node:fs'
import type { LaravelDatabase } from '~/types/laravel'
import type { Package } from '~/types/package'

const packagesPath = 'database/json/packages.json'
const laravelPath = 'database/json/laravel.json'

export const readPackagesDatabase = (): Package[] =>
    JSON.parse(readFileSync(packagesPath, 'utf-8'))

export const writePackagesDatabase = (laravelPackages: Package[]) =>
    writeFileSync(packagesPath, JSON.stringify(laravelPackages, null, 4))

export const readLaravelDatabase = (): LaravelDatabase => {
    if (!existsSync(laravelPath) || readFileSync(laravelPath, 'utf-8').trim() === '') {
        const defaultData: LaravelDatabase = {
            active_versions: [],
        }
        writeFileSync(laravelPath, JSON.stringify(defaultData, null, 4), 'utf-8')
        return defaultData
    }
    else {
        return JSON.parse(readFileSync(laravelPath, 'utf-8'))
    }
}

export const writeLaravelDatabase = (laravelDatabase: LaravelDatabase) =>
    writeFileSync(laravelPath, JSON.stringify(laravelDatabase, null, 4))