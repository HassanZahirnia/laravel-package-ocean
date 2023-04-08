import Knex from 'knex'
import { Model } from 'objection'
import inquirer from 'inquirer'
import gradient from 'gradient-string'
import chalk from 'chalk'
import config from './knexfile'
import { Package } from './models/Package'

// eslint-disable-next-line no-console
const log = console.log

const asciiArt = `
   ___                         ___   __   _____ 
  /___\\___ ___  __ _ _ __     / __\\ / /   \\_   \\
 //  // __/ _ \\/ _\` | '_ \\   / /   / /     / /\\/
/ \\_// (_|  __/ (_| | | | | / /___/ /___/\\/ /_  
\\___/ \\___\\___|\\__,_|_| |_| \\____/\\____/\\____/  
`


log(gradient('cyan', 'pink').multiline(asciiArt))

// Initialize knex.
const knex = Knex(config.development)

// Give the knex instance to objection.
Model.knex(knex)

async function main() {
    const packages = await Package.query()

    log(packages)
}

async function stats() {
    const packages = await Package.query()
    const composerPackages = await Package.query().whereNotNull('composer')
    const npmPackages = await Package.query().whereNotNull('npm')
    const nonComposerNpmPackages = await Package.query().whereNull('composer').whereNull('npm')

    log(`
Total Packages: ${chalk.cyan(packages.length)}

  Composer: ${chalk.cyan(composerPackages.length)}     Npm: ${chalk.cyan(npmPackages.length)}     Other: ${chalk.cyan(nonComposerNpmPackages.length)}
    `)
}

// main()
//     .then(() => knex.destroy())
//     .catch((err) => {
//         console.error(err)
//         return knex.destroy()
//     })

stats().then(() => process.exit(0))

// Exit the program


// inquirer
//     .prompt([
//         {
//             type: 'list',
//             name: 'menu',
//             message: 'What do you want to do?',
//             choices: [
//                 'Add a new package',
//                 'Update a package',
//                 'Delete a package',
//                 'Exit',
//             ],
//         },
//     ])
//     .then((answers) => {
//         switch (answers.menu) {
//             case 'Add a new package':
//                 // Add a new package
//                 break
//             case 'Update a package':
//                 // Update a package
//                 break
//             case 'Delete a package':
//                 // Delete a package
//                 break
//             case 'Exit':
//                 // Exit
//                 break
//             default:
//                 break
//         }
//     })