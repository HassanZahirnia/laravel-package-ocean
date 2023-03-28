export const useSearch = () => useState<string>('search')
export const useSelectedCategory = () => useState<string>('selectedCategory', () => '')