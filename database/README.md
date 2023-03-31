Rules for `packages.ts`:
- The `composer` and `npm` and `description` and `github` properties should be unique.
- Only one of `composer` and `npm` should be defined at a time.
- The `github` property is used to identify a package.
- The `description` property needs to be less than 100 characters.
- The `keywords` words chosen should not be already included in the `name` and `description`.
- The `keywords` should be unique inside the array itself.
- The `category` should be in the list of categories.

General notes:
- Only add packages that are actively maintained and support recent versions of Laravel and PHP.
- Make sure none of the information provided use any foul language.
- Try to remove repeating common words from `description`, like "Laravel" or "Package".
- The `description` should not be vague or anything like "Best package ever!".
- The `description` should not repeat the `name` of the package.