/* eslint-disable no-console */
import { readFileSync, writeFileSync } from 'node:fs'
import { orderBy } from 'lodash'
import axios from 'axios'
import chalk from 'chalk'
import type { Package } from '@/types/package'
import { categories } from '@/database/categories'

const log = console.log

async function updatePackages() {
    const packagesPath = 'database/packages.ts'
    const packagesFile = readFileSync(packagesPath, 'utf-8')

    const packages: Package[] = eval(packagesFile.split(' = ')[1])

    const composerSet = new Set<string>()
    const npmSet = new Set<string>()
    const nameSet = new Set<string>()
    const descriptionSet = new Set<string>()
    const githubSet = new Set<string>()

    for (let i = 0; i < packages.length; i++) {
        const keywordSet = new Set<string>()
        const { composer, npm, name, description, github, keywords, updated_at } = packages[i]

        // If the package has no composer or npm
        if (!composer && !npm) 
            log(chalk.red(`'${github}' has no composer or npm`))

        // If the package has both composer and npm
        if (composer && npm)
            log(chalk.red(`'${github}' has both composer and npm`))

        // Check for uniqueness of composer, npm, name, description, and github properties
        if(composer){
            if (composerSet.has(composer)) {
                log(chalk.red(`'${composer}' is not unique`))
                continue
            }
            else {
                composerSet.add(composer)
            }
        }
        if(npm){
            if (npmSet.has(npm)) {
                log(chalk.red(`'${npm}' is not unique`))
                continue
            }
            else {
                npmSet.add(npm)
            }
        }

        if (nameSet.has(name)) 
            log(chalk.black(`Package with name '${name}' is not unique`))
        
        else 
            nameSet.add(name)
        

        if (descriptionSet.has(description)) {
            log(chalk.red(`Package with description '${description}' is not unique`))
            continue
        }
        else {
            descriptionSet.add(description)
        }

        if (githubSet.has(github)) {
            log(chalk.red(`Package with github '${github}' is not unique`))
            continue
        }
        else {
            githubSet.add(github)
        }

        // Check for description length
        if (description.length >= 100) {
            log(chalk.red(`'${composer || npm}' has a description longer than 100 characters`))
            continue
        }

        // Check for unique keywords and keywords not included in the package name and description
        for (let j = 0; j < keywords.length; j++) {
            const keyword = keywords[j]
            if (keywordSet.has(keyword)) {
                log(chalk.red(`'${composer || npm}' has a duplicate keyword '${keyword}'`))
                continue
            }
            else {
                keywordSet.add(keyword)
            }

            if (name.toLowerCase().includes(keyword.toLowerCase())) {
                log(chalk.red(`'${composer || npm}' has a keyword '${keyword}' that is already included in the package name`))
                continue
            }

            if (description.toLowerCase().includes(keyword.toLowerCase())) {
                log(chalk.red(`'${composer || npm}' has a keyword '${keyword}' that is already included in the package description`))
                continue
            }
        }

        // Check for category in the list of categories
        if (!categories.includes(packages[i].category)) {
            log(chalk.red(`'${composer || npm}' has an invalid category '${packages[i].category}'`))
            continue
        }

        // Skip updating the package if it has been updated in less than a day compared to the current time
        if (new Date(updated_at) > new Date(Date.now() - 24 * 60 * 60 * 1000)) 
            continue
        

        if(composer){
            const { data: packagistData } = await axios.get(`https://packagist.org/packages/${composer}.json`)
            const releases = packagistData.package.versions

            const releaseVersions = Object.keys(releases).filter(release => !releases[release].version.includes('dev'))
            const latestRelease = releaseVersions.reduce((a, b) => {
                const timeA = new Date(releases[a].time)
                const timeB = new Date(releases[b].time)
                return timeA > timeB ? a : b
            })

            packages[i].first_release_at = packagistData.package.time
            packages[i].latest_release_at = releases[latestRelease].time
        }
        else if(npm){
            const { data: npmData } = await axios.get(`https://registry.npmjs.org/${npm}`)
            packages[i].first_release_at = npmData.time.created
            packages[i].latest_release_at = npmData.time.modified
        }

        // Update Github stars
        const { data: githubData } = await axios.get(`https://api.github.com/repos/${packages[i].github.substring(19)}`)
        packages[i].stars = githubData.stargazers_count
        packages[i].updated_at = new Date().toISOString()

        log(chalk.greenBright(`Updated ${composer || npm || github}`))
    }

    // Order packages by category, and then by author, and then by name
    const sortedPackages = orderBy(packages,
        ['category', 'author', 'name'],
        ['asc', 'asc', 'asc'],
    )

    const updatedPackagesFile = `import type { Package } from '@/types/package'

export const laravelPackages: Package[] = ${JSON.stringify(
        sortedPackages,
        null,
        4,
    ).replace(/"/g, "'")};
`

    writeFileSync(packagesPath, updatedPackagesFile)

    log(chalk.cyan('---------------------------'))
    log(chalk.cyan('Finished update of packages'))
}

updatePackages()
