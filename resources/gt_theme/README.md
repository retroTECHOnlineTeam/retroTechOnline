# Drupal 7 GT Theme 3.2
## Prologue

### Is this the right thing for you?
Why, yes, in fact. Adherence to the new brand standards is mandatory, and failure to comply will be met, most likely, with grimaces and muttered curses.

In all seriousness, there are some technical hurdles to clear in order to get your site up-to-date with the new Georgia Tech branding. If you leave a step out of the installation process, your site will not behave properly. So take your time and make sure you follow the instructions carefully. If you follow the instructions but run into technical trouble, email us at webteam@gatech.edu, cc’ing Elise Berk (elise.berk@comm.gatech.edu), with the details of the failure. Please include information about exactly where the process broke down and what, if any, error messages appear on screen.

If you need closer assistance, Institute Communications will be allocating some number of hours of our time to help with support questions. Contact Elise Berk (elise.berk@comm.gatech.edu) and Louise Russo (louise.russo@gatech.edu) for details.

### A word on dropdown menus in this theme
This theme was designed using Bootstrap, which implements a click to trigger dropdown menus. In addition to being a default feature of Bootstrap, using a click to trigger a dropdown aligns better with accessibility best practices which allow users to navigate through menu items with a keyboard. It also provides a more consistent user experience across device types.

With this new feature, there is no longer an option for a parent link from top-level menu items. To solve this issue, the theme update will automatically generate linkable sub-menu items for any top-level menu parent links it finds.

Top-level menu labels that have sub-menus will now display a caret arrow icon to the right of the label, which indicates that the top-level menu item is a dropdown. Clicking on, or pressing enter on a top-level item opens the sub menu. The first sub-menu item will be a duplicate of the top-level menu label if it is a link. Pressing enter on any sub-menu menu item opens the related page link.

Example: http://repo.drupal.gatech.edu/sites/default/files/images/droppy001.png

Top-level menu items that do not have sub-menus, will show an underline on hover. In this case, the underline indicates that by clicking it, the user will follow a link to another page. If using keyboard navigation, pressing enter on the top-level menu item opens the page link.

Example: http://repo.drupal.gatech.edu/sites/default/files/images/droppy002.png

Action Links (on the right end of the menu bar) will display a right-facing sideways caret, which indicates that clicking on it will open the related page link.

Example: http://repo.drupal.gatech.edu/sites/default/files/images/droppy003.png

## Note about the GT Carousel Module

The GT Carousel module/feature has been removed from the GT Theme.

As we announced in 2017, due to UX and accessibility concerns, Institute Communications no longer recommends the use of the module. It was also announced in 2017 that Institute Communications would no longer maintain or support the module, and advised against installing it on new websites.

For more information about carousel use and accessibility, please visit: http://dx.drupal.gatech.edu/handbook/should-i-use-carousel.

## Installation Instructions

### Get the theme
Go to http://repo.drupal.gatech.edu/sites/default/files/resources/gt-7.x-3.2.tar.gz. Download the file, unzip it, and make sure that the resulting directory is named “gt.” Move it to your sites/all/themes directory, replacing the preexisting GT theme.

### Do you have the jQuery Update module installed?
**Yes.** Go to [yoursite.gatech.edu]/admin/config/development/jquery_update and make sure the default jQuery version is 1.9. That's right, 1.9. 1.10 will cause some other administrative UI elements to fail.

**No.** Go to https://ftp.drupal.org/files/projects/jquery_update-7.x-2.7.tar.gz. Download, unzip, and avoid the temptation to rename it. Move it to yoursite.com/sites/all/modules. Go to [yoursite.gatech.edu]/admin/modules, find the module in the list, switch it on, and click “Save configuration.” Then go to [yoursite.gatech.edu]/admin/config/development/jquery_update and make sure the default jQuery version is 1.9. See above.

### Enable the theme
Just kidding. If the GT theme was enabled before, t’s enabled now. But you might need to clear your Drupal caches. Go to [yoursite.gatech.edu]/admin/config/development/performance and click the button that reads “Clear All Caches.”

When this is done, give your site a careful review. Any problems that don’t have an obvious solution, let us know.

## Coda

Thanks to James Logan and the OIT Quality Assurance team for going over our work with their fine-tuned accessibility comb. Also thanks to the members of the campus Drupal Users Group, especially Eric Sembrat, Adelle Frank, Michael Sheldon, and Kevin Pittman, for their many QA checks, as well as indulging our surly attitudes and many deliberately awkward silences.
