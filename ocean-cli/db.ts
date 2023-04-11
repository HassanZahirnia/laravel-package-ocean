import { JsonDB, Config } from 'node-json-db'
import { laravelPackageSchema } from '~/ocean-cli/validation-rules'
import type { Package } from '~/types/package'

const db = new JsonDB(new Config('./database/json/packages', true, false, '/'))

async function readRecord(){
    return await db.getObject<Package>('/')
}

readRecord().then((data) => {
    const result = laravelPackageSchema.safeParse(data)

    if (!result.success) {
        const errors = result.error.errors
        // Add a new property to each object in the errors array
        // that would be like the following:
        // package: { id: 1, name: 'Laravel Backup' }
        // the data for the package should be taken from the data variable based on the path property
        // So a path of [7, 'description'] would mean that the package is the 8th item in the array.
        console.log(errors.map((error) => {
            const path = error.path
            const package = data[path[0]]
            return {
                // Insert error without the code property
                path: error.path,
                message: error.message,
                package: {
                    id: package.id,
                    name: package.name,
                },
            }
        }))
    }
})