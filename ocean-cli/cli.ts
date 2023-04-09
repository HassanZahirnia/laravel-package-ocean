import inquirer from 'inquirer'
import { clearScreen, printLogo, showPackageStats } from '~/ocean-cli/print'
import { showPackageSearch } from '~/ocean-cli/package/search'
import { initObjection } from '~/ocean-cli/knex'
import { compileToJSON } from '~/ocean-cli/compile'

// Initialize Objection and Knex (database)
initObjection()

// Clear the screen
clearScreen()

// Print the logo
printLogo()

export const showMainMenu = function(){
    inquirer
        .prompt([
            {
                type: 'list',
                name: 'menu',
                message: 'Main menu:',
                loop: false,
                choices: [
                    'Database: Compile To JSON',
                    'Package: Add',
                    'Package: Search',
                    'Package: Run Health Check',
                    'Package: Update All',
                    'Package: Update Compatible Versions',
                    'Package: Update Github Stars',
                    'Exit',
                ],
            },
        ])
        .then((answers) => {
            switch (answers.menu) {
                case 'Database: Compile To JSON':
                    compileToJSON()
                        .then(() => showMainMenu())
                    break
                case 'Package: Search':
                    showPackageSearch()
                    break
                case 'Exit':
                    process.exit(0)
            }

        })
}

showPackageStats().then(() => showMainMenu())