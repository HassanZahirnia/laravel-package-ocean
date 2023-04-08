import type { Knex } from 'knex'
import { Package } from '../models/Package'
import { laravelPackages } from '../database/packages'

export async function seed(knex: Knex): Promise<void> {
    Package.knex(knex)

    // Deletes ALL existing entries
    await knex('packages').del()

    // Loop through laravelPackages and insert each into the database
    for (const item of laravelPackages)
        await Package.query().insert(item)
}
