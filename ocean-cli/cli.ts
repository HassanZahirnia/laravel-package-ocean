import inquirer from 'inquirer'
import chalk from 'chalk'
import { laravelPackageSchema } from './validation-rules'
import { readPackagesDatabase } from './database'
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
const validateJsonFlag = process.argv.includes('--validate-json')
if (validateJsonFlag) {
    const laravelPackages = readPackagesDatabase()
    const validationResult = laravelPackageSchema.safeParse(laravelPackages)

    if (!validationResult.success) 
        log(chalk.bgRed('Validation failed!'))
}
else{
// Clear the screen
    clearScreen()

    // Print the logo
    printLogo()

    showPackageStats().then(() => showMainMenu())
}