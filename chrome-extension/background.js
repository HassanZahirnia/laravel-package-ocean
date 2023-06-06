chrome.runtime.onInstalled.addListener(() => {
    console.log('Extension installed.')
})

chrome.tabs.onUpdated.addListener((tabId, changeInfo, tab) => {
    if (changeInfo && changeInfo.status === 'complete' && tab.url && tab.url.includes('github.com')) {

        const isInDatabase = checkIfRepositoryExists(tab.url)

        if (isInDatabase)
            chrome.action.setIcon({ tabId, path: 'icons/icon-color.png' })

        else
            chrome.action.setIcon({ tabId, path: 'icons/icon-gray.png' })

    }
})

function checkIfRepositoryExists(url) {
    const packages = []

    const foundPackage = packages.find(package => package.github === url)

    return !!foundPackage
}
