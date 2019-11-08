# retroTechOnline


## Getting Started



### Prerequisites

- PHP
- node/npm

```
Give examples
```

### Setup

A step by step series of examples that tell you how to get a development env running

1. Make sure the ArchiveSpace API creds are stored and available in a file named api_creds.php in the base directory structured like so:

```
<?php 

define('USERNAME', '*****');
define('PASSWORD', '*****');
define('BASE_URI', 'https://archivesspace.library.gatech.edu/_api');
define('REPO_ID', 2);

?>
```

2. Compile assets

```
npm run production
```

3. Start server

```
php artisan serve
```

End with an example of getting some data out of the system or using it for a little demo

# Overall System Diagram
![System Diagram](RetroTech Online System Diagram.jpg)

## Panel Types and Contents
- Oral History
    -- oral history subject
    -- OHMS link
    -- screenshot
- Emulation
    -- EaaS link
    -- software screenshot
- Live Software
    -- OIT link
    -- software screenshot
- Lab Info
    -- lab photo