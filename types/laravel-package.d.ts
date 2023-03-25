import { categories } from '@/database/categories'

export type LaravelPackage = {
    name: string
    description: string
    category: typeof categories[number]
    github: string
    repo: string
    composer: string
    stars: number
    keywords: string[]
}
