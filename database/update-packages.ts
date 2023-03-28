import { readFileSync, writeFileSync } from 'node:fs'
import execa from 'execa'
import type { Package } from '@/types/package'

async function updatePackages() {
    const packagesPath = 'database/packages.ts'
    const packagesFile = readFileSync(packagesPath, 'utf-8')

    const packages: Package[] = eval(packagesFile.split(' = ')[1])

    for (let i = 0; i < packages.length; i++) {
        const { github, repo } = packages[i]

        const { stdout: stars } = await execa('curl', ['-s', `https://api.github.com/repos/${github.substring(19)}`])
        const starsCount = JSON.parse(stars).stargazers_count

        packages[i].stars = starsCount

        // eslint-disable-next-line no-console
        console.log(`Updated ${repo} with ${starsCount} stars.`)
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
