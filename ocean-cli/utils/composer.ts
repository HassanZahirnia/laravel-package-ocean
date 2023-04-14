export type packagistData = {
    package: {
        time: string
        versions: {
            [key: string]: {
                time: string
                version: string
                require: {
                    [key: string]: string
                }
                'require-dev': {
                    [key: string]: string
                }
            }
        }
    }
}

export const extract_packagist_first_release_at = (packagistData: packagistData) => packagistData.package.time

export const extract_packagist_latest_release = (packagistData: packagistData) => {
    const releases = packagistData.package.versions
    const releaseVersions = Object.keys(releases).filter(release => !releases[release].version.includes('dev'))
    const latestRelease = releaseVersions.reduce((a, b) => {
        const timeA = new Date(releases[a].time)
        const timeB = new Date(releases[b].time)
        return timeA > timeB ? a : b
    })

    return latestRelease
}

export const extract_packagist_latest_release_at = (packagistData: packagistData) => {
    const latestRelease = extract_packagist_latest_release(packagistData)
    return packagistData.package.versions[latestRelease].time
}

export const extract_packagist_detected_compatible_versions = (packagistData: packagistData) => {
    const releases = packagistData.package.versions
    const latestRelease = extract_packagist_latest_release(packagistData)
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

    return [...new Set(cleanedVersions)]
}