import { laravelPackages } from '@/database/packages'

export default defineEventHandler((event) => {
    const query = getQuery(event)
    const githubUrl = query.github
    const exists = laravelPackages.some(item => item.github === githubUrl)
    return {
        exists,
    }
})