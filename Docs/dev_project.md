# Project Documentation for Developers #

## Introduction ##

This documentation is directed towards new developers working on this project. Here you'll learn the basic ideas,
structure and mindset behind this project. Most of the mentioned guidelines and best practices are mandatory if you
want to provide modules or core changes to this project. It is recommended to review this documentation from time to
time in order to stay up to date although changes will be notified to all developers.

Changes and updates can be introduced by every core developer and will be discussed and afterwards either included
or discarded. This duration of this process depends highly on the proposed changes.

## Project Structure ##



## Performance & Coding Style Guidelines ##

### PHP ###

1. Use `echo` for outputting something on screen.
2. Use single quotes and manually concatenate strings with variables if necessary.
3. Initialize variables with `null` and use `isset` for value checks.
4. Avoid multi-level for/while/foreach loops.
5. Use caching, either file cache or `memcache` for database queries and other cachable data.
6. Use output buffer control.
7. Avoid unnecessary getters/setters.
8. Use OpCache.
9. Avoid multiline `echo`. Concatenate `echo`.
10. Single line `echo` should be done with short tags `<?= 'Hi'; ?>`

### HTML ###

1. Avoid `charset` metatag if you are able to set a PHP header.
2. Don't use closing strokes for `<br>`.
3. Define important styles you would like to apply as soon as poosible inside the `head`.
4. Reduce external files/http requests by combining JS and CSS files if possible and useful.
5. Minimize html (remove line breaks)
6. Load CSS and JS at the bottom of page, right before the `</body>` tag (if possible).
7. Try to keep the DOM flat.

### CSS ###

1. Never prefix IDs with another selector (e.g. `.nav #top {}`).
2. Avoid unnecessary selectors (e.g. `ul li a {}` vs. `ul a {}`)
3. Avoid too general selectors (e.g. `body * {}`)
4. Don't write the same styles for different selectors, use the `,` to define styles for multiple selectors.
5. Use CSS minimizers to reduce file size.
6. Try to use short selector names (e.g. `#snav` instead of `#sidenavigation`)
7. Use gzip compression.
8. Use CSS for animations instead of JS if possible.
9. Inline critical CSS styles in the `<head>`

### JS ###

1. Use the shorthand array declaration (e.g. `var arr = [1, 2, 3]`).
2. Save selected elements instead of re-selecting them (e.g. `var test = $("#test")`)
3. Use JS minimizers to reduce file size.
4. Use gzip compression.
5. Avoid actions that take extra browser round trips (e.g. `:visible` selector)
6. Use deferred loading for JS.

### SQL ###

1. Keep database access to a minimum, use caching.
2. Try to select by `KEY` if possible.
3. Pool commits.
4. Don't do SQL queries inside a loop.

### General ###

1. Images used for the page layout should be combined to a sprite sheet.
2. Use image optimizers for images used inside the page layout, in order to reduce their size.
3. Avoid bad requests.
4. Avoid redirects
5. Set static resources cachable.
6. Use scalable images where necessary.
7. Keep the amount of cookies low.
8. Serve resources from a static source and preferable from a URL where no cookies are set.
9. Provide framework files from external hosts (e.g. google) and provide a local fallback.
10. Use cloud hosting.
11. Optimize for mobile browsers (don't serve JS files they can't use).

## GUI Guidelines ##

## User Interaction ##

1. Avoid asking the user if he really wants to do something. Rather make the action the user made reversible.
2. Only ask the user if he wants to proceed if the upcoming process takes a long time, is performance intensive or irreversible.
3. Don't create a bar at the top like google if you don't have valuable elements to fill it.