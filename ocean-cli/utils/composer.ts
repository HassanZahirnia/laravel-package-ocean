import semver from 'semver'
import chalk from 'chalk'
import axios, { isAxiosError } from 'axios'
import dotenv from 'dotenv'
import ora from 'ora'
import { clearScreen, log } from '../print'
import { laravelPackageSchema } from '../validations/package.validation'
import { readPackagesDatabase, writePackagesDatabase } from '../database'

dotenv.config()

export type packagistData = {
    package: {
        time: string
        versions: {
            [key: string]: {
                time: string
                version: string
                require: {
                    [key: string]: string
                }
                'require-dev': {
                    [key: string]: string
                }
            }
        }
    }
}

export const extract_packagist_first_release_at = (packagistData: packagistData) => packagistData.package.time

export const extract_packagist_latest_release = (packagistData: packagistData): string => {
    const releases = packagistData.package.versions
    const releaseVersions = Object.keys(releases).filter(release => !releases[release].version.includes('dev'))
    const latestRelease = releaseVersions.reduce((a, b) => {
        const timeA = new Date(releases[a].time)
        const timeB = new Date(releases[b].time)
        return timeA > timeB ? a : b
    })

    return latestRelease
}

export const extract_packagist_latest_release_at = (packagistData: packagistData): string => {
    const latestRelease = extract_packagist_latest_release(packagistData)
    return packagistData.package.versions[latestRelease].time
}

export const extract_packagist_laravel_dependency_versions = (packagistData: packagistData): string[] => {
    const releases = packagistData.package.versions
    const latestRelease = extract_packagist_latest_release(packagistData)

    const supportedVersions = new Set<string>()
    const dependencies = { ...releases[latestRelease].require, ...releases[latestRelease]['require-dev'] }
    for (const dependency in dependencies) {
        if (dependency.startsWith('illuminate/') || dependency === 'laravel/framework'){
            const convertedVersion = convertLegacySemver(dependencies[dependency])
            const version = semver.validRange(convertedVersion)
            if (version)
                supportedVersions.add(convertedVersion)
        }
    }
    return Array.from(supportedVersions)
}

function convertLegacySemver(version: string): string{
    // Replace all single | not followed by another | with ||
    version = version.replace(/\|(?!\|)/g, '||')
    // And remove any @dev from the version
    version = version.replace(/@dev/g, '')

    return version
}

export const updateAllCompatibleVersions = async function(){
    clearScreen()

    const laravelPackages = readPackagesDatabase()

    const totalPackages = laravelPackages.length
    const notFoundPackages: string[] = []
    const unknownErrors: string[] = []

    const spinner = ora('Starting updating compatible versions').start()

    for (const laravelPackage of laravelPackages) {
        if (!laravelPackage.composer)
            continue

        spinner.prefixText = `${laravelPackages.indexOf(laravelPackage) + 1}/${totalPackages}`

        try {
            spinner.start(`${laravelPackage.name}`)

            let updatedDependencies = false

            const { data: packagistData }: { data: packagistData }
                = await axios.get(`https://packagist.org/packages/${laravelPackage.composer}.json`)

            if (extract_packagist_laravel_dependency_versions(packagistData).length){
                laravelPackage.laravel_dependency_versions = extract_packagist_laravel_dependency_versions(packagistData)
                updatedDependencies = true
            }
            else if (!laravelPackage.laravel_dependency_versions.length) {
                spinner.info(`${laravelPackage.composer} doesn't have any Laravel dependencies!`)
            }

            const validationResult = laravelPackageSchema.safeParse(laravelPackage)

            if (!validationResult.success) {
                spinner.fail('Validation failed!')
                log(validationResult.error.errors.map(error => error.message).join('\n'))
            }
            else if (updatedDependencies) {
                writePackagesDatabase(laravelPackages)
                spinner.succeed()
            }


        }
        catch (error) {
            if (isAxiosError(error)) {
                if (error.response && error.response.status === 404){
                    const message = `\n ${laravelPackage.composer} does not exist anymore!`
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
Finished updating compatible versions for ${chalk.cyan(totalPackages)} packages!
`)

    if (notFoundPackages.length || unknownErrors.length) {
        log(`
  Not Found: ${chalk.red(notFoundPackages.length)}    Unknown Errors: ${chalk.red(unknownErrors.length)}
        `)
    }
}