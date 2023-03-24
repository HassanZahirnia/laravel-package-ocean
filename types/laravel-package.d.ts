export type LaravelPackageCategory = 
    'File Management' |
    'Roles & Permissions' |
    'Validation' |
    'Logging & Audit'

export type LaravelPackage = {
    name: string
    description: string
    repo: string
    github: string
    stars: number
    category: LaravelPackageCategory
}