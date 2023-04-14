import inquirer from 'inquirer'
import { writeActiveLaravelVersion } from './utils/laravel'
import { validateJson } from './utils/health'
import { clearScreen, printLogo, showPackageStats } from '~/ocean-cli/print'
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
                    'Health: Validate JSON',
                    'Health: Validate JSON (Verbose)',
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
                case 'Health: Validate JSON':
                    validateJson()
                    break
                case 'Health: Validate JSON (Verbose)':
                    validateJson({ verbose: true })
                    break
                case 'Exit':
                    process.exit(0)
            }

        })
}

const verboseFlag = process.argv.includes('--verbose')
const validateJsonFlag = process.argv.includes('--validate')
const updateActiveLaravelVersionsFlag = process.argv.includes('--update-active-laravel-versions')

if (validateJsonFlag) {
    validateJson({ verbose: verboseFlag })
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