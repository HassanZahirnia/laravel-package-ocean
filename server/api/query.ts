import fs from 'node:fs'
import type { Package } from '~/types/package'

export default defineEventHandler((event) => {
    const query = getQuery(event)
    const githubUrl = query.github
    const packages: Package[] = Array.from(JSON.parse(fs.readFileSync('database/json/packages.json', 'utf8')))
    const exists = packages.some(item => item.github === githubUrl)
    return {
        exists,
    }
})