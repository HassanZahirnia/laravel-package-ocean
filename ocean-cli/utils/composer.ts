import semver from 'semver'

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

export const extract_packagist_latest_release = (packagistData: packagistData): string => {
    const releases = packagistData.package.versions
    const releaseVersions = Object.keys(releases).filter(release => !releases[release].version.includes('dev'))
    const latestRelease = releaseVersions.reduce((a, b) => {
        const timeA = new Date(releases[a].time)
        const timeB = new Date(releases[b].time)
        return timeA > timeB ? a : b
    })

    return latestRelease
}

export const extract_packagist_latest_release_at = (packagistData: packagistData): string => {
    const latestRelease = extract_packagist_latest_release(packagistData)
    return packagistData.package.versions[latestRelease].time
}

export const extract_packagist_laravel_dependency_versions = (packagistData: packagistData): string[] => {
    const releases = packagistData.package.versions
    const latestRelease = extract_packagist_latest_release(packagistData)

    const supportedVersions = new Set<string>()
    const dependencies = { ...releases[latestRelease].require, ...releases[latestRelease]['require-dev'] }
    for (const dependency in dependencies) {
        if (dependency.startsWith('illuminate/') || dependency === 'laravel/framework'){
            const convertedVersion = convertLegacySemver(dependencies[dependency])
            const version = semver.validRange(convertedVersion)
            if (version)
                supportedVersions.add(convertedVersion)
        }
    }
    return Array.from(supportedVersions)
}

function convertLegacySemver(version: string): string{
    // Replace all single | not followed by another | with ||
    return version.replace(/\|(?!\|)/g, '||')
}