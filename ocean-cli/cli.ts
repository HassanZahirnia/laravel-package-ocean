import inquirer from 'inquirer'
import { clearScreen, printLogo, showPackageStats } from '~/ocean-cli/print'
import { showPackageSearch } from '~/ocean-cli/package/search'
import { initObjection } from '~/ocean-cli/knex'

initObjection()

clearScreen()

printLogo()

export const showMainMenu = function(){
    inquirer
        .prompt([
            {
                type: 'list',
                name: 'menu',
                message: 'Main menu:',
                choices: [
                    'Package: Add',
                    'Package: Search',
                    'Package: Run Health Check (outdated/archived repos)',
                    'Package: Update All (stars, compatible versions, etc.)',
                    'Package: Update Compatible Versions',
                    'Package: Update Github Stars',
                    'Exit',
                ],
            },
        ])
        .then((answers) => {
            switch (answers.menu) {
                case 'Package: Add':
                    break
                case 'Package: Search':
                    // Search for a package
                    showPackageSearch()

                    // Break
                    break
                case 'Exit':
                    // Exit the program
                    process.exit(0)
            }

        })
}

showPackageStats().then(() => showMainMenu())