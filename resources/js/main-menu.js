!function (document, Drupal, $) {
  'use strict';

  /**
   * Setup behaviors for Main Navigation.
   */

  Drupal.behaviors.mainNavigation = {

    initMainMenu: function initMainMenu(menu) {
      menu.once().accessibleMegaMenu({
        /* prefix for generated unique id attributes, which are required
           to indicate aria-owns, aria-controls and aria-labelledby */
        uuidPrefix: 'accessible-megamenu',

        /* css class used to define the megamenu styling */
        menuClass: 'nav-menu-mega-menu',

        /* css class for a top-level navigation item in the megamenu */
        topNavItemClass: 'nav-item-mega-menu',

        /* css class for a megamenu panel */
        panelClass: 'sub-nav-mega-menu',

        /* css class for a group of items within a megamenu panel */
        panelGroupClass: 'sub-nav-mega-menu-group',

        /* css class for the hover state */
        hoverClass: 'hover',

        /* css class for the focus state */
        focusClass: 'focus',

        /* css class for the open state */
        openClass: 'open'
      });
    },

    initMobileMenu: function initMobileMenu(mobilemenu) {
      mobilemenu.once().accessibleMegaMenu({
        /* prefix for generated unique id attributes, which are required
           to indicate aria-owns, aria-controls and aria-labelledby */
        uuidPrefix: 'accessible-megamenu-mobile',

        /* css class used to define the megamenu styling */
        menuClass: 'nav-menu-mega-menu-mobile',

        /* css class for a top-level navigation item in the megamenu */
        topNavItemClass: 'nav-item-mega-menu-mobile',

        /* css class for a megamenu panel */
        panelClass: 'sub-nav-mega-menu-mobile',

        /* css class for a group of items within a megamenu panel */
        panelGroupClass: 'sub-nav-mega-menu-group-mobile',

        /* css class for the hover state */
        hoverClass: 'hover-mobile',

        /* css class for the focus state */
        focusClass: 'focus-mobile',

        /* css class for the open state */
        openClass: 'open-mobile'
      });
    },

    attach: function attach(context) {
      Drupal.behaviors.mainNavigation.initMainMenu($('.main-menu', context));
    }

  };
}(document, Drupal, jQuery);
//# sourceMappingURL=main-menu.js.map
