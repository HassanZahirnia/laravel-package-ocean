import Knex from 'knex'
import { Model } from 'objection'
import config from '~/knexfile'

// Initialize knex.
export const knex = Knex(config.development)

// Give the knex instance to objection.
export const initObjection = () => Model.knex(knex)