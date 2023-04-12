import chalk from 'chalk'
import { readPackagesDatabase } from '../database'
import { laravelPackageArraySchema } from '../validation-rules'
import { log } from '../print'

export const validateJson = (
    { verbose = false } = {},
) => {
    const laravelPackages = readPackagesDatabase()
    const validationResult = laravelPackageArraySchema.safeParse(laravelPackages)

    if (!validationResult.success){ 
        log(chalk.bgRed('Validation failed!'))
        if (verbose) {
            const errorsWithGithub = validationResult.error.errors.map((error) => {
                const packageIndex = error.path[0] as number // Get the index of the package in the array
                const github = laravelPackages[packageIndex].github // Get the github property of the package
                return {
                    ...error,
                    github, // Add the github property to the error object
                }
            })
            log(errorsWithGithub)
        }
    }
}