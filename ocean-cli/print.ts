import gradient from 'gradient-string'
import chalk from 'chalk'
import { filter, isEmpty } from 'lodash'
import { readPackagesDatabase } from './database'

const asciiArt = `
   ___                         ___   __   _____ 
  /___\\___ ___  __ _ _ __     / __\\ / /   \\_   \\
 //  // __/ _ \\/ _\` | '_ \\   / /   / /     / /\\/
/ \\_// (_|  __/ (_| | | | | / /___/ /___/\\/ /_  
\\___/ \\___\\___|\\__,_|_| |_| \\____/\\____/\\____/  
`

// eslint-disable-next-line no-console
export const log = console.log

// Clear screen function
export const clearScreen = function() {
    process.stdout.write('\x1Bc')
}

export const printLogo = function() {
    log(gradient('cyan', 'pink').multiline(asciiArt))
}

export const showPackageStats = async function() {
    const laravelPackages = readPackagesDatabase()

    const composerPackages = filter(laravelPackages, item => !isEmpty(item.composer))
    const npmPackages = filter(laravelPackages, item => !isEmpty(item.npm))
    const nonComposerNpmPackages = filter(laravelPackages, item => isEmpty(item.composer) && isEmpty(item.npm))

    log(`
Total Packages: ${chalk.cyan(laravelPackages.length)}

  Composer: ${chalk.cyan(composerPackages.length)}     Npm: ${chalk.cyan(npmPackages.length)}     Other: ${chalk.cyan(nonComposerNpmPackages.length)}
    `)
}