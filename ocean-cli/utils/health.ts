import chalk from 'chalk'
import dayjs from 'dayjs'
import { readLaravelDatabase, readPackagesDatabase } from '../database'
import { laravelPackageArraySchema } from '../validation-rules'
import { log } from '../print'
import type { GithubData } from '~/types/github'
import type { Package } from '~/types/package'

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

export const pushed_at_is_old = (githubData: GithubData): boolean => {
    const latestCommitDate = dayjs(githubData.pushed_at)
    const threeMonthsAgo = dayjs().subtract(3, 'month')

    if(latestCommitDate < threeMonthsAgo)
        return true

    return false
}

// TODO Check active laravel version compatibility
export const is_compatible_with_active_laravel_versions = (laravelPackage: Package): boolean => {
    const { active_versions } = readLaravelDatabase()
    const package_compatible_versions = laravelPackage.compatible_versions.length
        ? laravelPackage.compatible_versions
        : laravelPackage.detected_compatible_versions

    return active_versions.some((activeVersion) => {
        return package_compatible_versions.some((compatibleVersion) => {
            const match = compatibleVersion.match(/^([<>]=?|>=|<=)(\d+)$/)
            if (!match)
                return activeVersion === compatibleVersion

            const operator = match[1]
            const version = parseInt(match[2])
            if (operator === '')
                return activeVersion === compatibleVersion

            else if (operator === '>=')
                return parseInt(activeVersion) >= version

            else if (operator === '<=')
                return parseInt(activeVersion) <= version

            else if (operator === '>')
                return parseInt(activeVersion) > version

            else if (operator === '<')
                return parseInt(activeVersion) < version

            return false
        })
    })
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

    if (pushed_at_is_old(githubData))
        return `${githubData.full_name} has not been updated in 3 months!`

    return true
}