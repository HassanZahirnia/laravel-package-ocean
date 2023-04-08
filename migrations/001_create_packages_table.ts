import type { Knex } from 'knex'


export async function up(knex: Knex): Promise<void> {
    await knex.schema.createTable('packages', (table) => {
        table.increments()
        table.string('name', 40).notNullable().index()
        table.string('description', 100).notNullable()
        table.string('category', 25).notNullable().index()
        table.string('github').notNullable().unique().index()
        table.string('author').notNullable().index()
        table.string('composer').nullable().unique().index()
        table.string('npm').nullable().unique().index()
        table.integer('stars').notNullable()
        table.json('keywords').notNullable()
        table.timestamp('first_release_at').notNullable()
        table.timestamp('latest_release_at').notNullable()
        table.json('detected_compatible_versions').notNullable()
        table.json('compatible_versions').notNullable()
        table.boolean('php_only').notNullable().defaultTo(false)
        table.timestamp('created_at').index()
        table.timestamp('updated_at').index()
    })
}


export async function down(knex: Knex): Promise<void> {
    await knex.schema.dropTable('packages')
}

