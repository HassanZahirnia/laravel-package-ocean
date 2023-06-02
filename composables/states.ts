export const useSearch = () => useState<string>('search')
export const useSelectedCategory = () => useState<string>('selectedCategory', () => '')
export const useShowOfficialPackages = () => useState<'0' | '1' | ''>('showOfficialPackages', () => '')