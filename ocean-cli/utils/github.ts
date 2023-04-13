import type { GithubData } from '~/types/github'

export const extract_github_stars = (githubData: GithubData): number => githubData.stargazers_count

export const extract_github_archived = (githubData: GithubData): boolean => githubData.archived

export const extract_github_pushed_at = (githubData: GithubData): string => githubData.pushed_at

