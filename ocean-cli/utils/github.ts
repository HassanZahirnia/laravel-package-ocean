export type GithubData = {
    stargazers_count: number
    archived: boolean
    pushed_at: string
}

export const extract_github_stars = (githubData: GithubData): number => githubData.stargazers_count

export const extract_github_archived = (githubData: GithubData): boolean => githubData.archived

export const extract_github_pushed_at = (githubData: GithubData): string => githubData.pushed_at

