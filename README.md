# retroTechOnline


## Getting Started

For development or deployment, follow the instructions below.


### Prerequisites

- [PHP 7.2](https://www.php.net/)
- [Composer Dependency Manager](https://getcomposer.org/)
- [node/npm](https://www.npmjs.com/)

### Setup

A step by step series of examples that tell you how to get a development env running

1. Install [Laravel](https://laravel.com/docs/5.7) using Composer, then run update from the base directory of the project.

```
composer global require "laravel/installer"
composer update
```


2. Make sure the ArchiveSpace API creds are stored and available in a file named "api_creds_prod.php" in the base directory structured like the example:
** Note this is not stored in VC and must be manually created/managed. **

```
<?php 

define('USERNAME', '*****');
define('PASSWORD', '*****');
define('BASE_URI', 'https://archivesspace.library.gatech.edu/_api');
define('REPO_ID', 2);

?>
```

2. Compile assets using Webpack/Laravel mix. This needs to be run everytime there are css or js changes.

```
npm run production
```

3. Create a cache for faster loading

```
php artisan view:cache
```

4. Start server

```
php artisan serve
```

***

## Overall System Diagram
![System Diagram](resources/assets/RetroTechOnlineSystemDiagram.png)

### Views

Can be found under resources/views/

#### Full Page Templates

Consist of one or more Panel Layouts as well as the GT theme

- [template1.blade.php](resources/views/template1.blade.php) - template used for testing
- [template2_1.blade.php](resources/views/template2_1.blade.php) - two-up 50-50 of emulation and lab
    - currently unused
- [template2_2.blade.php](resources/views/template2_2.blade.php) - two-up 50-50 of oral history and lab
    - currently unused
- [template2_series.blade.php](resources/views/template2_series.blade.php) - series of two-up panels
    - title (collection title)
    - series title
    - series uri
    - Series Entry Panels
    - Used by: CS 2261 GBA Games
- [template3_1.blade.php](resources/views/template3_1.blade.php) - three-up
    - Emulation
    - Oral history
    - Lab
- [template3_2.blade.php](resources/views/template3_2.blade.php) - three-up
    - Oral history
    - Software
    - Oral history 2
- [template4.blade.php](resources/views/template3_gallery.blade.php) - three-up with gallery
    - Oral history
    - Oral history
    - Lab
    - Gallery

##### Panel Layout Templates

Consist of two Panels side by side

- *depreciated* [twoupleft.blade.php](resources/views/twoupleft.blade.php) -
- *depreciated* [twoupright.blade.php](resources/views/twoupright.blade.php) -
- Series Entry: [seriesentry.blade.php](resources/views/seriesentry.blade.php) - a two-up 50-50 layout for use with template2_series
    - entry title
    - uri
    - creator name (agent)
    - description
    - Emulation Panel
    - Oral History Panel


##### Panel Types and Contents
- Oral History: [oralhistory.blade.php](resources/views/oralhistory.blade.php) and [oralhistory2.blade.php](resources/views/oralhistory2.blade.php) - screenshot and link to the OHMS instance of video oral history
    - oral history subject (person),
    - OHMS link,
    - screenshot,
- Emulation: [emulation.blade.php](resources/views/emulation.blade.php) - screenshot and link to the EaaS instance of the software
    - EaaS link,
    - software screenshot,
- Live Software: [software.blade.php](resources/views/software.blade.php) - screenshot and live download link of the software
    - OIT link,
    - software screenshot
- Lab Info: [lab.blade.php](resources/views/lab.blade.php) - a photo and link to the retroTECH main site
    - lab photo
- Gallery: [gallery.blade.php](resources/views/gallery.blade.php) - a series of media files (video/photos) with titles and descriptions


##### GT Library Theme Components

- [breadcrumbs.blade.php](resources/views/breadcrumbs.blade.php) - breadcrumbs bar under header menu
    - requires 'title'
- [header.blade.php](resources/views/header.blade.php) - Georgia Tech Library site header
- [footer.blade.php](resources/views/footer.blade.php) - Georgia Tech Library site footer


***
## Troubleshooting
### Clearing the cache
- If you get an error about a missing session, try stopping the server and clearing the cache

```
php artisan config:cache
```
### Dependency Issues
- To update composer to the latest version:

```
composer self-update
```
- To update all dependencies managed by composer (should be all of them):

```
composer update
```
### Adding New Classes
- To create new classes and make them available throughout the app, add the class to [composer.json](composer.json) autoload (see below), then run composer and restart the server.

```
"autoload": {
        "psr-4": {
            "App\\": "app/"
        },
        "files": [
            "app/ArchiveSpaceApi.php",
            "api_creds_prod.php",
            "app/Data.php",
            "path_to_your_class.php"
        ]
    },
```
```
composer update
php artisan serve

```
### Adding CSS or JS files
- To include new css files into the app build, make sure to include the filepath in [webpack.mix.js](webpack.mix.js)

- Remember to recompile and update the cache

```
npm run production
php artisan view:cache
```

## Further Documentation
- [Laravel 5.7 documentation](https://laravel.com/docs/5.7)
- [Laracast tutorial videos](https://laracasts.com/series/laravel-6-from-scratch)
- [ArchiveSpace API documentation](https://archivesspace.github.io/archivesspace/api/)