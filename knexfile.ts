import type { Knex } from 'knex'

const config: { [key: string]: Knex.Config } = {
    development: {
        client: 'sqlite3',
        useNullAsDefault: true,
        connection: {
            filename: './database/database.sqlite3',
        },
        seeds: {
            directory: './seeds',
        },
    },
}

export default config