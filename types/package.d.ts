import { categories } from '@/database/categories'

export type Category = typeof categories[number]

export type Package = {
    name: string
    description: string
    category: Category
    github: string
    composer: string
    author: string
    stars: number
    keywords: string[]
    first_release_at: string
    latest_release_at: string
}

export type PackageSortFields = 'first_release_at' | 'latest_release_at' | 'stars'