import { readFileSync, writeFileSync } from 'node:fs'
import type { Package } from '~/types/package'

export const readPackagesDatabase = (): Package[] =>
    JSON.parse(readFileSync('database/json/packages.json', 'utf-8'))

export const writePackagesDatabase = (laravelPackages: Package[]) =>
    writeFileSync('database/json/packages.json', JSON.stringify(laravelPackages, null, 4))