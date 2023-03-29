/* eslint-disable no-console */
import { readFileSync, writeFileSync } from 'node:fs'
import axios from 'axios'
import type { Package } from '@/types/package'

async function updatePackages() {
    const packagesPath = 'database/packages.ts'
    const packagesFile = readFileSync(packagesPath, 'utf-8')

    const packages: Package[] = eval(packagesFile.split(' = ')[1])

    for (let i = 0; i < packages.length; i++) {
        const { composer, updated_at } = packages[i]

        // Skip updating the package if it has been updated in less than a day compared to the current time
        if (new Date(updated_at) > new Date(Date.now() - 24 * 60 * 60 * 1000)) {
            console.log(`Skipping ${composer} because it has been updated recently`)
            continue
        }

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

        const { data: githubData } = await axios.get(`https://api.github.com/repos/${packages[i].github.substring(19)}`)
        packages[i].stars = githubData.stargazers_count
        packages[i].updated_at = new Date().toISOString()

        console.log(`Updated ${composer} with ${packages[i].stars} stars and first release at ${packages[i].first_release_at} and latest release at ${packages[i].latest_release_at}`)
    }

    const updatedPackagesFile = `import type { Package } from '@/types/package'

export const laravelPackages: Package[] = ${JSON.stringify(
        packages,
        null,
        4,
    ).replace(/"/g, "'")};
`

    writeFileSync(packagesPath, updatedPackagesFile)
}

updatePackages()
