import type { JSONSchema } from 'objection'
import { Model } from 'objection'
import type { Category } from '../types/category'
import { categories } from '../database/categories'

class Package extends Model {
    name!: string
    description!: string
    category!: Category
    github!: string
    author!: string
    composer!: string | null
    npm!: string | null
    stars!: number
    keywords!: string[]
    first_release_at!: string
    latest_release_at!: string
    detected_compatible_versions!: string[]
    compatible_versions!: string[]
    php_only!: boolean

    updated_at?: string | null
    created_at?: string | null

    static tableName = 'packages'

    $beforeInsert() {
        this.created_at = new Date().toISOString()
    }

    $beforeUpdate() {
        this.updated_at = new Date().toISOString()
    }

    static get jsonSchema(): JSONSchema {
        return {
            type: 'object',
            required: [
                'name',
                'description',
                'category',
                'github',
                'author',
                'composer',
                'npm',
                'stars',
                'keywords',
                'first_release_at',
                'latest_release_at',
                'detected_compatible_versions',
                'compatible_versions',
                'php_only',
            ],

            properties: {
                id: { type: 'integer' },
                name: { type: 'string', minLength: 2, maxLength: 40 },
                description: { type: 'string', minLength: 5, maxLength: 100 },
                category: { type: 'string', minLength: 2, maxLength: 25, enum: categories },
                github: { type: 'string', minLength: 19 },
                author: { type: 'string', minLength: 2 },
                composer: { type: ['string', 'null'], minLength: 2 },
                npm: { type: ['string', 'null'], minLength: 2 },
                stars: { type: 'integer', minimum: 0 },
                keywords: {
                    type: 'array',
                    uniqueItems: true,
                    items: {
                        type: 'string',
                    },
                },
                first_release_at: { type: 'string', minLength: 20 },
                latest_release_at: { type: 'string', minLength: 20 },
                detected_compatible_versions: {
                    type: 'array',
                    uniqueItems: true,
                    items: {
                        type: 'string',
                    },
                },
                compatible_versions: {
                    type: 'array',
                    uniqueItems: true,
                    items: {
                        type: 'string',
                    },
                },
                php_only: { type: 'boolean' },
            },
        }
    }
}

export { Package }