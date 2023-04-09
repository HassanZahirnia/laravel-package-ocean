import inquirer from 'inquirer'
import chalk from 'chalk'
import { clearScreen, log, printLogo, showPackageStats } from '~/ocean-cli/print'
import { showPackageSearch } from '~/ocean-cli/package/search'
import { initObjection } from '~/ocean-cli/knex'
import { compileToJSON } from '~/ocean-cli/compile'

// Initialize Objection and Knex (database)
initObjection()

export const showMainMenu = function(){
    inquirer
        .prompt([
            {
                type: 'list',
                name: 'menu',
                message: 'Main menu:',
                pageSize: 10,
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
                        .then(() => log('\n', chalk.cyan('Database has been compiled to JSON!'), '\n'))
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

// Check if --compile-database-to-json argument is passed
const compileDatabaseToJsonFlag = process.argv.includes('--compile-database-to-json')
if (compileDatabaseToJsonFlag) {
    compileToJSON()
        .then(() => log('\n', chalk.cyan('Database has been compiled to JSON!'), '\n'))
        .then(() => process.exit(0))
}
else{
    // Clear the screen
    clearScreen()

    // Print the logo
    printLogo()

    showPackageStats().then(() => showMainMenu())
}