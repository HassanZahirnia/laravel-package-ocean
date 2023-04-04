/* eslint-disable no-console */
import { readFileSync, writeFileSync } from 'node:fs'
import { orderBy } from 'lodash'
import axios from 'axios'
import chalk from 'chalk'
import dotenv from 'dotenv'
import type { Package } from '@/types/package'
import { categories } from '@/database/categories'

dotenv.config()

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
        const { composer, npm, name, description, github, keywords, updated_at, category, author } = packages[i]

        // If the package has no composer or npm
        if (!composer && !npm) {
            log(chalk.red(`'${github || composer || npm || name || description}' has no composer or npm`))
            continue
        }

        // If package has no github, name, description, give a warning and continue
        if (!github || !name || !description || !category || !author) {
            log(chalk.red(`'${github || composer || npm || name || description || category || author}' is missing one of the following: github, name, description, category, author`))
            continue
        }

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

        // Skip updating the package if it has been updated in less than 2 days compared to the current time
        if (new Date(updated_at) > new Date(Date.now() - 2 * 24 * 60 * 60 * 1000))
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

            // Only try to detect Laravel compatible versions if the package is not PHP only
            // And when the package has no compatible versions set manually
            if(!packages[i].php_only && packages[i].compatible_versions.length === 0){
                
                // Go through the latest release and get the list of compatible Laravel versions
                // So it can be a `illuminate` dependency, or a `laravel` dependency,
                // and save it in the `detected_compatible_versions` property
                // Example output: ['8', '9', '10']
                const supportedVersions = []
                const dependencies = { ...releases[latestRelease].require, ...releases[latestRelease]['require-dev'] } // merge require and require-dev
                const versionRegex = /((\^|\~|\>|\<|\>=|\<=)?(\d+)(\.\d+)*(\s*\|\|\s*)?)+/g
                for (const dependency in dependencies) {
                    if (dependency.startsWith('illuminate/') || dependency === 'laravel/framework') {
                        const version = dependencies[dependency]
                        let match = versionRegex.exec(version)
                        while (match !== null) {
                            const versionMatches = match[0].split('||').map(v => v.trim())
                            const cleanedVersions = versionMatches.map((v) => {
                                const versionMatch = /(\^|\~|\>|\<|\>=|\<=)?(=)?(\d+)(\.\d+)*/.exec(v)
                                if (versionMatch) {
                                    const operator = versionMatch[1] ? versionMatch[1].replace(/\d/g, '') : ''
                                    const equals = versionMatch[2] || ''
                                    const versionNumber = versionMatch[3]
                                    return operator + equals + versionNumber
                                }
                                return ''
                            }).filter(v => v !== '').sort((a, b) => {
                                const aParsed = a.replace(/(\^|\~|\>|\<|\>=|\<=)?(=)?/g, '')
                                const bParsed = b.replace(/(\^|\~|\>|\<|\>=|\<=)?(=)?/g, '')
                                const aSemVer = aParsed.split('.').map(v => parseInt(v))
                                const bSemVer = bParsed.split('.').map(v => parseInt(v))
                                for (let i = 0; i < Math.max(aSemVer.length, bSemVer.length); i++) {
                                    if (aSemVer[i] === undefined) 
                                        return -1
                    
                                    else if (bSemVer[i] === undefined) 
                                        return 1
                    
                                    else if (aSemVer[i] !== bSemVer[i]) 
                                        return aSemVer[i] - bSemVer[i]
                    
                                }
                                return 0
                            })
                            supportedVersions.push(...cleanedVersions)
                            match = versionRegex.exec(version)
                        }
                    }
                }
                const uniqueVersions = [...new Set(supportedVersions)]
                const cleanedVersions = uniqueVersions.map(version => version.replace(/[^\d\>\<=]/g, '')).sort((a, b) => {
                    const aParsed = a.replace(/(\^|\~|\>|\<|\>=|\<=)?(=)?/g, '')
                    const bParsed = b.replace(/(\^|\~|\>|\<|\>=|\<=)?(=)?/g, '')
                    const aSemVer = aParsed.split('.').map(v => parseInt(v))
                    const bSemVer = bParsed.split('.').map(v => parseInt(v))
                    for (let i = 0; i < Math.max(aSemVer.length, bSemVer.length); i++) {
                        if (aSemVer[i] === undefined) 
                            return -1
        
                        else if (bSemVer[i] === undefined) 
                            return 1
        
                        else if (aSemVer[i] !== bSemVer[i]) 
                            return aSemVer[i] - bSemVer[i]
        
                    }
                    return 0
                })
                packages[i].detected_compatible_versions = [...new Set(cleanedVersions)]


                // if no versions were detected, log a warning
                if (cleanedVersions.length === 0) 
                    log(chalk.yellow(`Could not detect any compatible versions for: '${composer || npm || github}'`))
            }
        }
        else if(npm){
            const { data: npmData } = await axios.get(`https://registry.npmjs.org/${npm}`)
            packages[i].first_release_at = npmData.time.created
            packages[i].latest_release_at = npmData.time.modified
        }

        // Update Github stars
        const { data: githubData } = await axios.get(`https://api.github.com/repos/${packages[i].github.substring(19)}`, {
            headers: {
                Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
            },
        })
        packages[i].stars = githubData.stargazers_count
        packages[i].updated_at = new Date().toISOString()

        // Repository is archived and/or read-only
        if (githubData.archived){ 
            log(chalk.bgRed('Warning!'))
            log(chalk.red(`'${github}' is archived and/or read-only`))
        }

        // Repository latest commit is older than specified months below:
        const months = 3
        const latestCommitDate = new Date(githubData.pushed_at)
        const twoMonthsAgo = new Date(Date.now() - months * 30 * 24 * 60 * 60 * 1000)

        if (latestCommitDate < twoMonthsAgo) 
            log(chalk.red(`Warning: The latest commit for ${composer || npm || github} was older than 2 months ago`))


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

async function updateActiveLaravelVersions() {
    const { data: laravelVersions } = await axios.get('https://laravelversions.com/api/versions')
    const activeVersions = laravelVersions.data.filter((version: { status: string }) => version.status === 'active')
    const activeVersionNumbers = activeVersions.map((version: { major: { toString: () => unknown } }) => version.major.toString())

    const laravel_versions_path = 'database/laravel-versions.ts'
    const laravel_versions_file = readFileSync(laravel_versions_path, 'utf-8')
    
    const updatedLaravelVersionsFile = laravel_versions_file.replace(
        /export const active_laravel_versions = \[.*\] as const/,
        `export const active_laravel_versions = ${JSON.stringify(activeVersionNumbers)} as const`,
    )

    writeFileSync(laravel_versions_path, updatedLaravelVersionsFile)


    log(chalk.cyan('---------------------------'))
    log(chalk.cyan('Finished update of active Laravel versions'))
}

updatePackages()

updateActiveLaravelVersions()