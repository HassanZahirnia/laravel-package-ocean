import axios from 'axios'

export type GithubData = {
    stargazers_count: number
    archived: boolean
    pushed_at: string
}

export const fetch_github_data = async(github: string) => {
    const { data: githubData } = await axios.get(`https://api.github.com/repos/${github.substring(19)}`, {
        headers: {
            Authorization: `Bearer ${process.env.GITHUB_TOKEN}`,
        },
    })
    return githubData as GithubData
}

export const extract_github_stars = (githubData: GithubData): number => githubData.stargazers_count

export const extract_github_archived = (githubData: GithubData): boolean => githubData.archived

export const extract_github_pushed_at = (githubData: GithubData): string => githubData.pushed_at

