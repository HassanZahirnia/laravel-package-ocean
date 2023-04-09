import { writeFileSync, mkdirSync } from 'node:fs'
import { resolve } from 'node:path'
import { Package } from '~/models/Package'

export const compileToJSON = async function(){
    const laravelPackages = await Package.query()
    const packagesPath = 'database/json/packages.json'

    // Map the laravelPackages and convert the `php_only` property to true/false
    const modifiedPackages = laravelPackages.map((pkg) => {
        return {
            ...pkg,
            php_only: pkg.php_only ? true : false,
        }
    })

    // Create the directory if it doesn't exist
    const dirPath = resolve(packagesPath, '..')
    mkdirSync(dirPath, { recursive: true })

    // Write the packages to a JSON file
    await writeFileSync(packagesPath, JSON.stringify(modifiedPackages, null, 4))
}
