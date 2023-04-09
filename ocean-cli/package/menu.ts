import inquirer from 'inquirer'
import chalk from 'chalk'
import { clearScreen, log } from '~/ocean-cli/print'
import type { Package } from '~/models/Package'
import { showMainMenu } from '~/ocean-cli/cli'

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
        .then(async(answers) => {
            switch (answers.menu) {
                case 'Update (online)':
                    // Break
                    break
                case 'Edit':
                    // Break
                    break
                case 'Delete':
                    // Delete the package
                    await laravelPackage.$query().delete()

                    // Clear the screen
                    clearScreen()

                    // Show a success message
                    log(chalk.magenta(`Package ${laravelPackage.github} has been deleted!
                    `))

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