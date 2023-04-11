import { readFileSync, writeFileSync } from 'node:fs'
import type { Package } from '~/types/package'

export const readPackagesDatabase = (): Package[] =>
    JSON.parse(readFileSync('database/json/packages.json', 'utf-8'))

export const writePackagesDatabase = (laravelPackages: Package[]) =>
    writeFileSync('database/json/packages.json', JSON.stringify(laravelPackages, null, 4))


// readRecord().then((data) => {
//     const result = laravelPackageSchema.safeParse(data)

//     if (!result.success) {
//         const errors = result.error.errors
//         // Add a new property to each object in the errors array
//         // that would be like the following:
//         // package: { id: 1, name: 'Laravel Backup' }
//         // the data for the package should be taken from the data variable based on the path property
//         // So a path of [7, 'description'] would mean that the package is the 8th item in the array.
//         console.log(errors.map((error) => {
//             const path = error.path
//             const package = data[path[0]]
//             return {
//                 // Insert error without the code property
//                 path: error.path,
//                 message: error.message,
//                 package: {
//                     id: package.id,
//                     name: package.name,
//                 },
//             }
//         }))
//     }
// })