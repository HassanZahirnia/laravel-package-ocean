import axios from 'axios'
import chalk from 'chalk'
import { orderBy } from 'lodash'
import { showMainMenu } from '../cli'
import { readLaravelDatabase, writeLaravelDatabase } from '../database'
import { clearScreen, log } from '../print'

export const fetch_active_laravel_versions = async() => {
    const { data: laravelVersions } = await axios.get('https://laravelversions.com/api/versions')
    const activeVersions = laravelVersions.data.filter((version: { status: string }) => version.status === 'active')
    const activeVersionNumbers = activeVersions.map((version: { latest: { toString: () => unknown } }) => version.latest.toString())

    return activeVersionNumbers
}

export const writeActiveLaravelVersion = async(
    { noMenu = false } = {},
) => {
    fetch_active_laravel_versions().then((activeVersions) => {
        const laravelDatabase = readLaravelDatabase()

        laravelDatabase.active_versions = orderBy(activeVersions, version => parseInt(version), 'desc')

        writeLaravelDatabase(laravelDatabase)

        // Clear the screen
        if (!noMenu)
            clearScreen()

        // Show a success message
        log(chalk.magenta(`Laravel active versions has been updated to ${activeVersions}`), '\n')

        // Show the main menu
        if (!noMenu)
            showMainMenu()
    }).catch((error) => {
        // Clear the screen
        if (!noMenu)
            clearScreen()

        // Show an error message
        log(chalk.yellow('An error occurred while updating the Laravel active versions!'), '\n')
        log(chalk.red(error), '\n')

        // Show the main menu
        if (!noMenu)
            showMainMenu()
    })
}