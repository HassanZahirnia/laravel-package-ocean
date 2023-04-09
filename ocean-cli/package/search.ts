import inquirer from 'inquirer'
import inquirerPrompt from 'inquirer-autocomplete-prompt'
import MiniSearch from 'minisearch'
import { showPackageMenu } from '~/ocean-cli/package/menu'
import { Package } from '~/models/Package'
import { clearScreen, log } from '~/ocean-cli/print'
import { laravelPackages } from '~/database/packages'

// Register the autocomplete prompt
inquirer.registerPrompt('autocomplete', inquirerPrompt)

// Initialize the minisearch instance
const miniSearch = new MiniSearch({
    idField: 'github',
    fields: [
        'name',
        'github',
        'author',
        'composer',
        'npm',
    ],
    searchOptions: {
        fuzzy: 0.1,
        prefix: true,
    },
})

// Index all packages
miniSearch.addAll(laravelPackages)

export const showPackageSearch = function(){
    inquirer.prompt({
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        type: 'autocomplete',
        name: 'github',
        message: 'Enter your search term:',
        source: (answersSoFar: unknown, input = '') => {
            let results = laravelPackages
            const searchResult = miniSearch.search(input)

            results = searchResult.map(searchResultItem => results.find(laravelPackage => laravelPackage.github === searchResultItem.id)).filter(Boolean) as typeof laravelPackages

            return results.map(result => result.github)
        },
    })
        .then(
            async(answers) => {
                const result = await Package.query().where('github', answers.github).first()

                clearScreen()

                log(result?.toJSON())

                showPackageMenu(result as Package)
            },
        )
}