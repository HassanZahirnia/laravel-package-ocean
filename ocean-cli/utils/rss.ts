import fs from 'node:fs'
import RSS from 'rss'
import { readPackagesDatabase } from '../database'

export const generateRSSFeed = async() => {
    const packagesDatabase = readPackagesDatabase()

    const feed = new RSS({
        title: 'Laravel Package Ocean - Discover new Laravel packages',
        description: 'A place where you can find any Laravel package that you may need for your next project.',
        feed_url: 'https://laravel-package-ocean.com/rss.xml',
        site_url: 'https://laravel-package-ocean.com',
        language: 'en',
    })

    packagesDatabase.forEach((item) => {
        feed.item({
            title: item.name,
            guid: item.github,
            url: item.github,
            description: item.description,
            date: new Date(item.created_at as string),
        })
    })

    const rssXml = feed.xml()

    // Write the RSS feed to public/rss.xml
    fs.writeFileSync('public/rss.xml', rssXml)
}

generateRSSFeed()
