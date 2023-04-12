import axios from 'axios'

export type npmData = {
    time: {
        created: string
        modified: string
    }
}

export const fetch_npm_data = async(npm: string) => {
    const { data: npmData } = await axios.get(`https://registry.npmjs.org/${npm}`)
    return npmData as npmData
}

export const extract_npm_first_release_at = (npmData: npmData): string => npmData.time.created

export const extract_npm_latest_release_at = (npmData: npmData): string => npmData.time.modified

