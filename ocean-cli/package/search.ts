import inquirer from 'inquirer'
import inquirerPrompt from 'inquirer-autocomplete-prompt'
import { find } from 'lodash'
import MiniSearch from 'minisearch'
import { laravelPackages } from '~/database/packages'
import { showPackageMenu } from '~/ocean-cli/package/menu'
import { clearScreen, log } from '~/ocean-cli/print'
import type { Package } from '~/types/package'

// Register the autocomplete prompt
inquirer.registerPrompt('autocomplete', inquirerPrompt)

export const showPackageSearch = async function(){
    // Initialize the minisearch instance
    const miniSearch = new MiniSearch({
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

    inquirer.prompt({
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        type: 'autocomplete',
        name: 'github',
        message: 'Enter your search term:',
        source: (answersSoFar: unknown, input = '') => {
            let results = laravelPackages
            const searchResult = miniSearch.search(input)

            // Filter out packages that are not in the search result
            results = searchResult.map(searchResultItem => results.find(laravelPackage => laravelPackage.id === searchResultItem.id)).filter(Boolean) as typeof laravelPackages

            // Return package name followed by github url
            return results.map(result => `${result.name} (${result.github})`)
        },
    })
        .then(
            (answers) => {
                clearScreen()

                // Extract the GitHub URL from answers.github
                const githubUrl = answers.github.slice(answers.github.lastIndexOf('(') + 1, answers.github.lastIndexOf(')')).trim()

                // Get the package that matches the extracted GitHub URL
                const result = find(laravelPackages, laravelPackage => laravelPackage.github === githubUrl) as Package

                log(result)

                showPackageMenu(result)
            },
        )
}