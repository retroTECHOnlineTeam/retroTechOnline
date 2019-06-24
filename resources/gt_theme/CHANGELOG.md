GT Theme 7.x-3.2, 2019-04-15
----------------------------
- Added support for 2nd (or 3rd depending how you count 'em) submenus.
- Added menu header duplication for submenus.
- Added option to remove breadcrumbs.
- Various minor CSS issues.
- Fixed some minor bugs.
- Added a special secret Easter egg.

GT Theme 7.x-3.1, 2019-04-05
----------------------------
- Added support for submenus.
- Made the superfooter somewhat more legible.
- Added support for social media icons in footer.
- A bunch of little tweaks and bugfixes.
- Probably something really important I'm forgetting.

GT Theme 7.x-3.0, 2019-01-10
----------------------------
- New headers and footers featuring luscious browns and tans and beiges like a
  garden snail on a fallen leaf.
- Bootstrap is now included in the theme if you're into that kind of thing.

GT Theme 7.x-2.9, 2017-06-05
----------------------------
- Fixed an XSS vulnerability in the footer template.
- Updated some footer links.
- Gritted my teeth and rolled my eyes.

GT Theme 7.x-2.8, 2017-01-05 [Commit#: ]
--------------------------------------
- Bug fix: correct error that always removed the superfooter.
- Bug fix: correct project status url (remove httpS)
- Add final CSS styles for Google CSE search results table.
- Update template.php to use theme path for preprocess_node and process_page,
  so that it is easier for subthemes to use this correctly.

GT Theme 7.x-2.7, 2017-01-04 [Commit#: b0f75546e702053b2e879ce9b20254cadd2fd89c]
--------------------------------------
- SUBTHEME: if copied into your subtheme, first update these files:
  templates/html.tpl.php (skip-links)
  templates/maintenance-page.tpl.php (skip-links and footer copyright)
  templates/page.tpl.php (search and left-nav)
  inc/template.footer.inc (copyright and new theme options)
  inc/template.superfooter.inc (remove, and corrected links)
  template.php
  theme-settings.php
  js/gt.js (search)
  inc/template.site_search.inc (deleted)
- Search:
  Make search accessible by screenreaders and keyboard users.
  Remove theme settings option for user choice and Google Search Appliance:
  Core search (or integrated google_cse module) is now the default.
  Add basic CSS styling for search results page if using google_cse module:
  this will not be updated unless accessibility issues are found.
- Menus:
  Fix first menu item hidden on mobile view (Thank you, Scott Riggle!)
  Correct links in Superfooter menus
- Add theme setting options to:
  remove superfooter (default=no)
  login redirect to whichever page login started on (default=yes)
  use alternate base link for login (if admin uses different URL than public)
- Update FontAwesome CDN from 4.5.0 to 4.7.0 (and remove included fontawesome copy)
- Logos:
  Allow uploaded logos in SVG and GIF formats
  Increase footer logo 200% for retina displays
  Update College of Design logo (from old College of Architecture)
- Add higher contrast border to input text fields on forms.
- Remove inaccessible display:none from skip-links id
- Remove year from copyright in footer
- Correct and specify menublocks styling
- Hide additional ids in print.css
- Where possible, simplify code and add error checking
- Remove 404 easter egg
- Add CKEditor styles for:
  aligning text to the left, center or right
  hidden headings that are invisible except to screenreaders


GT Theme 7.x-2.6, 2016-02-09 [Commit#: 00c7a4d677c9fe77bcff822774cd01443128b099]
--------------------------------------
- Standardize GT web color palette
- So that contrast is accessible under the WCAG 2.0 AAA standard, colors have been updated for:
   highlight links, menus, search, layout pages, blocks, and super blocks.
   Regular text based links will now use a well-tested blue (#1a0dab).
- To increase screen reader navigability, added ARIA roles and title/label attributes to html.
- Move super block and hg_reader styles into main theme.
- Add new styles/design treatments for menu blocks & additional highlight link color
- Use https for "Search all of GT"
- Update links to GT campus map and Coop/Internship
- Update FontAwesome CDN to 4.5.0
- Update default settings: use 2.5 style, hide home page title, search local site, use minimum collapsed footer, turn on login link
- Some typography improvements.

GT Theme 7.x-2.5.1, 2015-04-30
--------------------------------------
- Fixing handleTouchMenu js function to include $(this) argument
- Maintenance patch: Fixed link behavior to reveal sub-links on first click in mobile view of main menu.

GT Theme 7.x-2.5, 2015-04-24
--------------------------------------
- Added new styling selection option in theme settings for switching to new layout/style treatments
  while remaining backwards-compatible with previous styling to avoid breaking custom subthemes.
  Version 2.5 also includes new styles for use in the GT Tools block classes options:
  Icons for block titles:
  icon-institution (displays: http://fontawesome.github.io/Font-Awesome/icon/university/)
  icon-mortar-board (http://fontawesome.github.io/Font-Awesome/icon/graduation-cap/)
  Block title treatments:
  block-title-bg-gt-blue - GT Navy blue background w/ white text
  block-title-bg-gt-gold - GT "Buzz" gold background w/ white text
  block-title-bg-gray - "Dark" gray background (#545454) w/ white text
- Added new breadcrumb option in theme settings to allow for additional parent "home" before GT Home
- Converted Font Awesome to use CDN, and latest version (4.3.0)
- Tweaked social media icons to use different font awesome version (the non-sign version)
- Added check fo live/on js event issue for compatibility with newer versions of jQuery.
- Returned default font weight for <strong> to use font-weight: bold for better rendering in Windows
- Removed deprecated minimum-scale=1.0, maximum-scale=1.0, and user-scalable=no values from
  "viewport" meta tag
- Added a default maintenance mode page and associated styling (uses the v2.5 "look")
- Fixed the focus action for the search text field so it works for all options (local, GT, and
  user-choice)
- Fixed misc. typos in theme settings form
- Introduces the use of the Roboto font family from Google fonts as the default body font.
- Removed the absolute positioning of the header/branding strip structure
and menu (in desktop viewports), which will allow for a more graceful
degradation when menus break to two lines.
- The overall max-width of the page structure is pushed out to 1170px
(in desktop viewports), which will also help with robust main menus.

GT Theme 7.x-2.4, 2014-12-17
--------------------------------------
- If you have custom page.tpl.php files in a subtheme, you'll need to change
the superfooter/footer mark up (see new page.tpl.php for details on
how to use these new variables).
- New settings available for theme:
    Hide the page title on the home page
    Collapse the super footer
    Superfooter Menus: choose between:
      Full Georgia Tech Default - same set of super footer menus from
        home page of www.gatech.edu;
      Georgia Tech Minimum - just the menu from the left column in the
        super footer of the home page at www.gatech.edu, but the menu will
        be broken up into four shorter menus; or
      Configurable - three fully configurable menus in your site's super footer.
- New superfooter options (default menus, make collapsable, etc.)
  Default page.tpl.php file now uses .inc files for footer and superfooter.
  You'll need to update any custom page.tpl.php files accordingly to take advantage of using default
  menu options, or the collapsible super footer option.
- Tweaks to overall typography display (converted font weights to use fixed value instead of generic value)
- Converted social media menu to use Font Awesome icons instead of .png background images
- Fixed name of IAC logo file (old file remains to avoid braking image links)

GT Theme 7.x-2.3, 2014-10-16
--------------------------------------
- Modifying print.css (hiding masthead,support,right sidebar, super footer and footer utility links)
- Footer overhaul with new legal links for accreditation and accessibility,
  plus login links overhaul (if you have opted to include a custom page.tpl.php
  file in your subtheme, be sure to update it accordingly).
- Removing proxyreload hidden input form from GT google appliance search
- Changing 33% to 33.33% throughout
- Fixed extra quote on #main section tag
- Removing white bg and 1x padding from floated inset images
- Adding Foundation Sans (a Helvetica Neue knock-off) and Palladio FS (a Palatino knock-off) fonts
- Tweaking min height of #masthead from 198px to 200px
- Adding IE conditionals
- Fixing unneeded -7px bottom margin on #masthead

GT Theme 7.x-2.2, 2013-12-20
--------------------------------------
- Fixed default street address to use HTML markup instead of new line breaks
- Fixed IE conditional <div>s in html.tpl.php to target specific versions
  (they were incorrectly using "less than" when targeting versions)
- Added styling to support new "cutline" text option in CKEditor style dropdown
- Updated directory link to use www.directory.gatech.edu as the default if GT Directory module isn't turned on
- Modified js behaviors for main menu so parent links will click through
  without requiring a double click, and if a <nolink> option is used via
  special menu items module the link will look and behave like a normal link
- The default CKEditor styles js file is now inline with what is available with GT Editor feature
- Fixed custom map image link
- Fixed main menu selection so that it respects user choice for main menu
- Other stying tweaks made to inline floated images, and
  included some preliminary styling for GT Slideshow feature

GT Theme 7.x-2.1, 2013-10-09
--------------------------------------
- Fixed disappearing map images.

GT Theme 7.x-2.0, 2013-09-30
--------------------------------------
- Initial release
