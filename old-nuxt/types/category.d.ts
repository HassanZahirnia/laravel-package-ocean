export type Category =
    'File Management' |
    'Auth & Permissions' |
    'Database & Eloquent' |
    'Debugging & Dev Tools' |
    'Dev Ops' |
    'Localization' |
    'API' |
    'SEO' |
    'Testing' |
    'Payment' |
    'Security' |
    'Mail' |
    'E-Commerce' |
    'CMS & Admin Panels' |
    'Code Architecture' |
    'Notifications' |
    'UI & Blade Components' |
    'Utilities & Helpers'

export type CategoryWithPackagesCount = {
    name: Category
    packagesCount: number
}