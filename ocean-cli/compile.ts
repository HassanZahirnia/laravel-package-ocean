import { writeFileSync } from 'node:fs'
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

    // Write the packages to a JSON file
    await writeFileSync(packagesPath, JSON.stringify(modifiedPackages, null, 4))
}
