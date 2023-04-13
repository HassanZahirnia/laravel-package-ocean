export type GithubData = {
    full_name: string
    stargazers_count: number
    pushed_at: string
    archived: boolean
    private: boolean
    disabled: boolean
    message?: 'Not Found'
}