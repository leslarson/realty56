# Realty56.com - a "project" realty website
#### Created 2024 by Les Larson

I wanted to create a full project utilizing PHP and Laravel in the back-end, with Blade templating creating the user pages and JavaScript/jQuery/Bootstrap for the front-end.

I am a software developer. I don't claim to be a web "designer" or graphic designer, so the interface is as friendly in appearance as I can make it. My purpose here is to show my skill at thinking logically and efficiently to produce code (back-end and front-end) that works as designed and expected.

I chose Laravel as the PHP framework because it is popular, robust, and comfortable to work with. I could have used Symfony or another framework... I prefer to use Laravel, and I really enjoy working with it.

I used vanilla JavaScript where it was comfortable to do so, and jQuery where it was convenient. I could have used either in most cases, I just went with the flow at the time.

All code is original except for two cases: the *default* scaffolding provided by Laravel for a new project, and a JavaScript component called "Tom Select" (https://tom-select.js.org/) which greatly simplified the "city / zip code" entry control on the main page. As stated before, I'm not a graphic designer, so I used the Tom Select component to clean up that control's appearance and functionality.

The realty data is pulled from an API (https://rapidapi.com/apidojo/api/realty-in-us/) and stored in a local MySQL database. The textual details are rendered at runtime, and the property image is pulled at that time from the API. Selecting a property opens another page, which itself is rendered on-the-fly with image and property detail pulled at that time from the API.

For the purposes of simplicity (since this is not a production site) the data in the local database is not updated automatically. That could be accomplished simply enough with a cron job that could either fire a Laravel work job or a perl script.

The live site is hosted online, at https://realty56.com.

Total time to develop this project (concept, research, development and debugging) was 20 days.
