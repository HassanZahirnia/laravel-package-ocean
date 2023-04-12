import axios from 'axios'
import chalk from 'chalk'
import { showMainMenu } from '../cli'
import { readLaravelDatabase, writeLaravelDatabase } from '../database'
import { clearScreen, log } from '../print'

export const fetch_active_laravel_versions = async() => {
    const { data: laravelVersions } = await axios.get('https://laravelversions.com/api/versions')
    const activeVersions = laravelVersions.data.filter((version: { status: string }) => version.status === 'active')
    const activeVersionNumbers = activeVersions.map((version: { major: { toString: () => unknown } }) => version.major.toString())

    return activeVersionNumbers
}

export const writeActiveLaravelVersion = (
    { noMenu } = { noMenu: false },
) => {
    fetch_active_laravel_versions().then((activeVersions) => {
        const laravelDatabase = readLaravelDatabase()

        laravelDatabase.active_versions = activeVersions

        writeLaravelDatabase(laravelDatabase)

        // Clear the screen
        if(!noMenu)
            clearScreen()

        // Show a success message
        log(chalk.magenta(`Laravel active versions has been updated to ${activeVersions}`), '\n')

        // Show the main menu
        if(!noMenu)
            showMainMenu()
    }).catch((error) => {
        // Clear the screen
        if(!noMenu)
            clearScreen()

        // Show an error message
        log(chalk.yellow('An error occurred while updating the Laravel active versions!'), '\n')
        log(chalk.red(error), '\n')

        // Show the main menu
        if(!noMenu)
            showMainMenu()
    })
}