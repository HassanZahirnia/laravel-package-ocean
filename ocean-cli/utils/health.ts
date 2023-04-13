import chalk from 'chalk'
import dayjs from 'dayjs'
import { readPackagesDatabase } from '../database'
import { laravelPackageArraySchema } from '../validation-rules'
import { log } from '../print'

export type GithubData = {
    pushed_at: string
    archived: boolean
}

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

export const latest_github_commit_is_old = (githubData: GithubData): boolean => {
    const latestCommitDate = dayjs(githubData.pushed_at)
    const threeMonthsAgo = dayjs().subtract(3, 'month')

    if(latestCommitDate < threeMonthsAgo)
        return true

    return false
}

export const is_archived = (githubData: GithubData): boolean => {
    return githubData.archived
}

// TODO Check active laravel version compatibility