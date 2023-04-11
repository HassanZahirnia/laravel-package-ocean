import inquirer from 'inquirer'
import chalk from 'chalk'
import { removePackage } from './remove'
import { clearScreen, log } from '~/ocean-cli/print'
import { showMainMenu } from '~/ocean-cli/cli'
import type { Package } from '~/types/package'

export const showPackageMenu = function(laravelPackage: Package){
    inquirer
        .prompt([
            {
                type: 'list',
                name: 'menu',
                message: 'Select an action:',
                choices: [
                    'Update (online)',
                    'Edit',
                    'Delete',
                    'Back to main menu',
                ],
            },
        ])
        .then((answers) => {
            switch (answers.menu) {
                case 'Update (online)':
                    // Break
                    break
                case 'Edit':
                    // Break
                    break
                case 'Delete':
                    // Delete the package
                    removePackage(laravelPackage)

                    // Clear the screen
                    clearScreen()

                    // Show a success message
                    log(chalk.magenta(`Package ${laravelPackage.github} has been deleted!`), '\n')

                    // Show the main menu
                    showMainMenu()

                    // Break
                    break
                case 'Back to main menu':
                    // Show the main menu
                    showMainMenu()

                    // Break
                    break
            }

        })
}