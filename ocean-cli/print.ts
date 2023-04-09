import gradient from 'gradient-string'
import chalk from 'chalk'
import { Package } from '~/models/Package'

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
    const packages = await Package.query()
    const composerPackages = await Package.query().whereNotNull('composer')
    const npmPackages = await Package.query().whereNotNull('npm')
    const nonComposerNpmPackages = await Package.query().whereNull('composer').whereNull('npm')

    log(`
Total Packages: ${chalk.cyan(packages.length)}

  Composer: ${chalk.cyan(composerPackages.length)}     Npm: ${chalk.cyan(npmPackages.length)}     Other: ${chalk.cyan(nonComposerNpmPackages.length)}
    `)
}