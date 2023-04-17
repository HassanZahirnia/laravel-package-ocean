import database from './json/packages.json'
import type { Package, PackageType } from '@/types/package'

export const laravelPackages = database as Package[]

export const packageTypes: PackageType[] = [
    'laravel-package',
    'php-package',
    'npm-package',
    'mac-app',
    'windows-app',
    'all-operating-systems-app',
    'ide-extension',
]