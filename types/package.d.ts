import { categories } from '@/database/categories'

export type Category = typeof categories[number]

export type Package = {
    name: string
    description: string
    category: Category
    github: string
    repo: string
    composer: string
    stars: number
    keywords: string[]
}
