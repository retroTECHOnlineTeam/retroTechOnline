!function (document, Drupal, $) {
  'use strict';

  /**
   * Setup behaviors for Search Bar.
   */

  Drupal.behaviors.searchBar = {

    displayControl: function displayControl(group, index) {
      var showClass = 'js-html-show';
      group.removeClass(showClass).eq(index).addClass(showClass);
    },

    getUrlVars: function getUrlVars() {
      var vars = {};
      window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
      });
      return vars;
    },

    attach: function attach(context) {
      var $searchInput = $('.search-bar__form input[name="search"]', context);
      var $htmlGroup = $('.search-bar__form-footer', context);

      $('.search-bar__select-select', context).on('change', function () {
        var selected = $('.search-bar__select-select option:selected', context);
        Drupal.behaviors.searchBar.displayControl($htmlGroup, selected.index());
      }).change();

      $htmlGroup.find('form').on('submit', function () {
        var query = $searchInput.val();
        var $queryField = $(this).find('input.query');

        if ($queryField.data('prefix')) {
          query = $queryField.data('prefix') + query;
        }

        $queryField.val(query);
      });

      // Populate the search query.
      var params = Drupal.behaviors.searchBar.getUrlVars();

      if (typeof params.s !== 'undefined') {
        $searchInput.val(decodeURIComponent(params.s.replace(/\+/g, '%20')));
      }

      $('.search-bar__form', context).on('submit', function (e) {
        e.preventDefault();

        $htmlGroup.filter('.js-html-show').find('form').submit();
      });
    }

  };
}(document, Drupal, jQuery);
//# sourceMappingURL=search-bar.js.map
