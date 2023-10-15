import { readPackagesDatabase, writePackagesDatabase } from '../database'
import type { Package } from '../../types/package'

export const removePackage = (laravelPackage: Package) => {
    const laravelPackages = readPackagesDatabase()

    const newPackages = laravelPackages.filter(item => item.github !== laravelPackage.github)

    writePackagesDatabase(newPackages)
}