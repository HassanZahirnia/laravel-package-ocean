import inquirer from 'inquirer'
import { writeActiveLaravelVersion } from './utils/laravel'
import { runComposerChecks, runGithubChecks, validateJson } from './utils/health'
import { updateAllGithubStars } from './utils/github'
import { updateAllCompatibleVersions } from './utils/composer'
import { clearScreen, printLogo, showPackageStats } from './print'
import { showPackageSearch } from './package/search'
import { addPackage } from './package/add'
import { generateRSSFeed } from './utils/rss'

const updateAll = async function() {
    clearScreen()

    await Promise.resolve(writeActiveLaravelVersion())
    await Promise.resolve(updateAllCompatibleVersions())
    await Promise.resolve(updateAllGithubStars())
}

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
                    'Package: Update All',
                    'Package: Update Compatible Versions',
                    'Package: Update Github Stars',
                    'Laravel: Update Active Versions',
                    'Health: Check Github',
                    'Health: Check Composer',
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
                case 'Package: Update All':
                    updateAll()
                    break
                case 'Package: Update Compatible Versions':
                    updateAllCompatibleVersions()
                    break
                case 'Package: Update Github Stars':
                    updateAllGithubStars()
                    break
                case 'Laravel: Update Active Versions':
                    writeActiveLaravelVersion()
                    break
                case 'Health: Check Github':
                    runGithubChecks()
                    break
                case 'Health: Check Composer':
                    runComposerChecks()
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
const generateRSSFlag = process.argv.includes('--rss')
const updateActiveLaravelVersionsFlag = process.argv.includes('--update-active-laravel-versions')

if (validateJsonFlag) {
    validateJson({ verbose: verboseFlag })
}
else if (updateActiveLaravelVersionsFlag){
    writeActiveLaravelVersion({ noMenu: true })
}
else if (generateRSSFlag){
    generateRSSFeed()
} else {
    // Clear the screen
    clearScreen()

    // Print the logo
    printLogo()

    showPackageStats().then(() => showMainMenu())
}