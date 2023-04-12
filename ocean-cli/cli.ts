import inquirer from 'inquirer'
import chalk from 'chalk'
import { laravelPackageArraySchema } from './validation-rules'
import { readPackagesDatabase } from './database'
import { writeActiveLaravelVersion } from './utils/laravel'
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
                    'Laravel: Update Active Versions',
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
                case 'Laravel: Update Active Versions':
                    writeActiveLaravelVersion()
                    break
                case 'Exit':
                    process.exit(0)
            }

        })
}

const verboseFlag = process.argv.includes('--verbose')
const validateJsonFlag = process.argv.includes('--validate-json')
const updateActiveLaravelVersionsFlag = process.argv.includes('--update-active-laravel-versions')

if (validateJsonFlag) {
    const laravelPackages = readPackagesDatabase()
    const validationResult = laravelPackageArraySchema.safeParse(laravelPackages)

    if (!validationResult.success){ 
        log(chalk.bgRed('Validation failed!'))
        if(verboseFlag)
            log(validationResult.error.errors)
    }
}
else if(updateActiveLaravelVersionsFlag){
    writeActiveLaravelVersion({ noMenu: true })
}
else{
    // Clear the screen
    clearScreen()

    // Print the logo
    printLogo()

    showPackageStats().then(() => showMainMenu())
}