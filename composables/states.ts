export const useSearch = () => useState<string>('search')
export const usePage = () => useState<number>('page')
export const usePageSize = () => useState<number>('pageSize', () => 2)