import chalk from 'chalk'
import dayjs from 'dayjs'
import semver from 'semver'
import ora from 'ora'
import axios, { isAxiosError } from 'axios'
import dotenv from 'dotenv'
import type { packagistData } from '../utils/composer'
import { readLaravelDatabase, readPackagesDatabase } from '../database'
import { laravelPackageArraySchema } from '../validations/package.validation'
import { clearScreen, log } from '../print'
import { laravelSchema } from '../validations/laravel.validation'
import type { GithubData } from '~/types/github'
import type { Package } from '~/types/package'

dotenv.config()

/**

---------------------------------------------------------------------------
:: Validation
---------------------------------------------------------------------------

*/
export const validateJson = (
    { verbose = false } = {},
) => {
    const laravelDatabase = readLaravelDatabase()
    const packagesDatabase = readPackagesDatabase()
    const packagesValidationResult = laravelPackageArraySchema.safeParse(packagesDatabase)
    const laravelValidationResult = laravelSchema.safeParse(laravelDatabase)

    if (!packagesValidationResult.success){
        log(chalk.red('✗ packages.json validation failed!'))
        if (verbose) {
            const errorsWithGithub = packagesValidationResult.error.errors.map((error) => {
                const packageIndex = error.path[0] as number // Get the index of the package in the array
                const github = packagesDatabase[packageIndex].github // Get the github property of the package
                return {
                    ...error,
                    github, // Add the github property to the error object
                }
            })
            log(errorsWithGithub)
        }

        process.exit(1)
    }

    if (!laravelValidationResult.success){
        log(chalk.red('✗ laravel.json validation failed!'))
        if (verbose)
            log(laravelValidationResult.error.errors)

        process.exit(1)
    }

    log(chalk.green('✓ All validations passed!'))
    process.exit(0)
}

/**

---------------------------------------------------------------------------
:: Github
---------------------------------------------------------------------------

*/
const oldMonths = 8

export const last_commit_is_very_old = (githubData: GithubData): boolean => {
    const latestCommitDate = dayjs(githubData.pushed_at)

    if (latestCommitDate < dayjs().subtract(oldMonths, 'month'))
        return true

    return false
}

export const github_is_healthy = (githubData: GithubData): string | true => {
    if (githubData.archived)
        return `${githubData.full_name} is archived!`

    if (githubData.private)
        return `${githubData.full_name} is private!`

    if (githubData.disabled)
        return `${githubData.full_name} is disabled!`

    if (githubData.message === 'Not Found')
        return `${githubData.full_name} does not exist!`

    if (githubData.open_issues_count >= 100)
        return `${githubData.full_name} has ${githubData.open_issues_count} open issues!`

    if (last_commit_is_very_old(githubData))
        return `${githubData.full_name} has not been updated in ${oldMonths} months!`

    return true
}

export const runGithubChecks = async function() {
    clearScreen()

    const laravelPackages = readPackagesDatabase()

    const totalPackages = laravelPackages.length
    let healthyPackages = 0
    const unhealthyPackages: string[] = []
    const notFoundPackages: string[] = []
    const unknownErrors: string[] = []

    const spinner = ora('Starting health check').start()

    for (const laravelPackage of laravelPackages) {
        spinner.prefixText = `${laravelPackages.indexOf(laravelPackage) + 1}/${totalPackages}`

        try {
            spinner.start(`${laravelPackage.name}`)

            const { data: githubData }: { data: GithubData } = await axios.get(`https://api.github.com/repos/${laravelPackage.github.substring(19)}`, {
                headers: {
                    Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
                },
            })

            const health = github_is_healthy(githubData)

            if (typeof health === 'string'){
                spinner.fail(health)
                unhealthyPackages.push(health)
            }
            else {
                spinner.succeed()
                healthyPackages++
            }
        }
        catch (error) {
            if (isAxiosError(error)) {
                if (error.response && error.response.status === 404){
                    const message = `\n ${laravelPackage.github} Does not exist anymore!`
                    notFoundPackages.push(message)
                    log(chalk.bgRed(message))
                }
            }
            else {
                unknownErrors.push(`\n ${laravelPackage.github} Unknown error!`)
                log(chalk.bgRed(error))
            }
        }
    }

    log(`
Finished checking github health of ${chalk.cyan(totalPackages)} packages!

  Healthy: ${chalk.green(healthyPackages)}     Un-healthy: ${chalk.magenta(unhealthyPackages.length)}
    `)

    if (notFoundPackages.length || unknownErrors.length) {
        log(`
  Not Found: ${chalk.red(notFoundPackages.length)}    Unknown Errors: ${chalk.red(unknownErrors.length)}
        `)
    }

    if (unhealthyPackages.length){
        log(chalk.magenta('Un-healthy packages: \n'))
        unhealthyPackages.forEach(unhealthyPackage => log(unhealthyPackage, '\n'))
    }
}

/**

---------------------------------------------------------------------------
:: Laravel/Composer
---------------------------------------------------------------------------

*/
export const is_compatible_with_active_laravel_versions = (laravelPackage: Package): boolean => {
    const { active_versions } = readLaravelDatabase()

    return active_versions.some((activeVersion) => {
        return laravelPackage.laravel_dependency_versions.some((compatibleVersion) => {
            const convertedActiveVersion = semver.valid(semver.coerce(activeVersion)) as string
            return semver.satisfies(convertedActiveVersion, compatibleVersion)
        })
    })
}

export const composer_is_healthy = (laravelPackage: Package, packagistData?: packagistData): string | true => {
    if (!is_compatible_with_active_laravel_versions(laravelPackage))
        return `${laravelPackage.composer} not compatible with active Laravel versions!!`

    return true
}

export const runComposerChecks = async function() {
    clearScreen()

    const laravelPackages = readPackagesDatabase()
        .filter(laravelPackage => laravelPackage.composer && laravelPackage.laravel_dependency_versions.length)

    const totalPackages = laravelPackages.length
    let healthyPackages = 0
    const unhealthyPackages: string[] = []
    const notFoundPackages: string[] = []
    const unknownErrors: string[] = []

    const spinner = ora('Starting health check').start()

    for (const laravelPackage of laravelPackages) {
        spinner.prefixText = `${laravelPackages.indexOf(laravelPackage) + 1}/${totalPackages}`

        try {
            spinner.start(`${laravelPackage.name}`)

            // const { data: packagistData }: { data: packagistData }
            //     = await axios.get(`https://packagist.org/packages/${laravelPackage.composer}.json`)

            const health = composer_is_healthy(laravelPackage)

            if (typeof health === 'string'){
                spinner.fail(health)
                unhealthyPackages.push(health)
            }
            else {
                spinner.succeed()
                healthyPackages++
            }
        }
        catch (error) {
            if (isAxiosError(error)) {
                if (error.response && error.response.status === 404){
                    const message = `\n ${laravelPackage.composer} Does not exist anymore!`
                    notFoundPackages.push(message)
                    log(chalk.bgRed(message))
                }
            }
            else {
                unknownErrors.push(`\n ${laravelPackage.composer} Unknown error!`)
                log(chalk.bgRed(error))
            }
        }
    }

    log(`
Finished checking composer health of ${chalk.cyan(totalPackages)} packages!

  Healthy: ${chalk.green(healthyPackages)}     Un-healthy: ${chalk.magenta(unhealthyPackages.length)}
    `)

    if (notFoundPackages.length || unknownErrors.length) {
        log(`
  Not Found: ${chalk.red(notFoundPackages.length)}    Unknown Errors: ${chalk.red(unknownErrors.length)}
        `)
    }

    if (unhealthyPackages.length){
        log(chalk.magenta('Un-healthy packages: \n'))
        unhealthyPackages.forEach(unhealthyPackage => log(unhealthyPackage, '\n'))
    }
}