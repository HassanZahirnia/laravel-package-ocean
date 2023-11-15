import ora from 'ora'
import axios, { isAxiosError } from 'axios'
import chalk from 'chalk'
import dotenv from 'dotenv'
import { readPackagesDatabase, writePackagesDatabase } from '../database'
import { clearScreen, log } from '../print'
import { laravelPackageSchema } from '../validations/package.validation'
import type { GithubData } from '../../types/github'

dotenv.config()

export const updateAllGithubStars = async function(){
    clearScreen()

    const laravelPackages = readPackagesDatabase()

    const totalPackages = laravelPackages.length
    const notFoundPackages: string[] = []
    const unknownErrors: string[] = []

    const spinner = ora('Starting updating Github stars').start()

    for (const laravelPackage of laravelPackages) {
        spinner.prefixText = `${laravelPackages.indexOf(laravelPackage) + 1}/${totalPackages}`

        try {
            spinner.start(`${laravelPackage.name}`)

            const { data: githubData }: { data: GithubData }
                = await axios.get(`https://api.github.com/repos/${laravelPackage.github.substring(19)}`, {
                    headers: {
                        Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
                    },
                })

            laravelPackage.stars = githubData.stargazers_count

            const validationResult = laravelPackageSchema.safeParse(laravelPackage)

            if (!validationResult.success) {
                spinner.fail('Validation failed!')
                log(validationResult.error.errors.map(error => error.message).join('\n'))
            }
            else {
                writePackagesDatabase(laravelPackages)
                spinner.succeed()
            }

        }
        catch (error) {
            if (isAxiosError(error)) {
                if (error.response && error.response.status === 404){
                    const message = `\n ${laravelPackage.github} does not exist anymore!`
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
Finished updating Github stars for ${chalk.cyan(totalPackages)} packages!
`)

    if (notFoundPackages.length || unknownErrors.length) {
        log(`
  Not Found: ${chalk.red(notFoundPackages.length)}    Unknown Errors: ${chalk.red(unknownErrors.length)}
        `)
    }
}