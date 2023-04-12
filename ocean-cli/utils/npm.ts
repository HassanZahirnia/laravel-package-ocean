export type NpmData = {
    time: {
        created: string
        modified: string
    }
}

export const extract_npm_first_release_at = (npmData: NpmData): string => npmData.time.created

export const extract_npm_latest_release_at = (npmData: NpmData): string => npmData.time.modified

