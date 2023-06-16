chrome.runtime.onInstalled.addListener(() => {
    console.log('Extension installed.')
})

chrome.tabs.onUpdated.addListener((tabId, changeInfo, tab) => {
    if (changeInfo
        && changeInfo.status === 'complete'
        && tab.url
        && tab.url.includes('github.com')
        && tab.url.match(/^https:\/\/github\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_.]+$/i)
    ) {
        checkIfGithubExists(tab.url)
            .then((isInDatabase) => {
                if (isInDatabase)
                    chrome.action.setIcon({ tabId, path: 'icons/icon-color.png' })

                else
                    chrome.action.setIcon({ tabId, path: 'icons/icon-gray.png' })

            })
            .catch((error) => {
                console.error('Error checking if repository exists:', error)
                chrome.action.setIcon({ tabId, path: 'icons/icon-gray.png' })
            })
    }
})


async function checkIfGithubExists(url) {
    return fetch(`https://laravel-package-ocean.com/api/query?github=${url}`)
        .then(response => response.json())
        .then((data) => {
            return data.exists
        })
        .catch(() => {
            return false
        })
}
