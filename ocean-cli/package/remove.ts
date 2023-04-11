import { writeFileSync } from 'node:fs'
import { laravelPackages } from '~/database/packages'
import type { Package } from '~/types/package'

export const removePackage = (laravelPackage: Package) => {
    const newPackages = laravelPackages.filter(item => item.id !== laravelPackage.id)
    
    writeFileSync('database/json/packages.json', JSON.stringify(newPackages, null, 4))
}