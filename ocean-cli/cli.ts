import inquirer from 'inquirer'
import chalk from 'chalk'
import { clearScreen, log, printLogo, showPackageStats } from '~/ocean-cli/print'
import { showPackageSearch } from '~/ocean-cli/package/search'
import { addPackage } from '~/ocean-cli/package/add'

export const showMainMenu = function(){
    inquirer
        .prompt([
            {
                type: 'list',
                name: 'menu',
                message: 'Main menu:',
                pageSize: 10,
                choices: [
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
                case 'Package: Add':
                    addPackage()
                    break
                case 'Package: Search':
                    showPackageSearch()
                    break
                case 'Exit':
                    process.exit(0)
            }

        })
}

// Check if --compile-database-to-json argument is passed
// const compileDatabaseToJsonFlag = process.argv.includes('--compile-database-to-json')
// if (compileDatabaseToJsonFlag) {
// }
// else{
// Clear the screen
clearScreen()

// Print the logo
printLogo()

showPackageStats().then(() => showMainMenu())
// }