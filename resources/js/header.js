!function (document, Drupal, $) {
  'use strict';

  /**
   * Setup behaviors for Header.
   */

  Drupal.behaviors.header = {

    toggleControl: function toggleControl(toggler) {
      var $container = $('.header__search-area');

      if ($container.hasClass('open')) {
        $container.attr('aria-hidden', 'false');
        toggler.attr('aria-expanded', 'true');
        toggler.attr('aria-pressed', 'true');
      } else {
        $container.attr('aria-hidden', 'true');
        toggler.attr('aria-expanded', 'false');
        toggler.attr('aria-pressed', 'false');
      }
    },

    attach: function attach(context) {

      $('.search-menu-toggle', context).on('click', function () {

        var $searchToggler = $('.header__search-area');
        var $this = $(this);

        if ($this.hasClass('accessible-megamenu-toggler')) {

          if ($this.hasClass('js-open')) {
            $this.removeClass('js-open');
          } else {
            $this.addClass('js-open');
            // This calls the accessible menu init function.
            // Adding it here allows the menu to initiate when it is needed
            //and visible.
            var $mobileMenu = $('.main-menu-mobile', context);
            Drupal.behaviors.mainNavigation.initMobileMenu($mobileMenu);
          }
        }

        $searchToggler.toggleClass('open');
        Drupal.behaviors.header.toggleControl($this);
      });
    }
  };
}(document, Drupal, jQuery);
//# sourceMappingURL=header.js.map
