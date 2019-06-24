/**
* @file
* js base functions
*
* Includes js behaviors for various toggles and switches
*
*/

(function($) {
  Drupal.behaviors.gt = {
    attach: function (context, settings) {

      // remove colorbox functionality for screens less than 600px wide
      $(function() {
        if ($(window).width() < '600') {
          $('a.colorbox').removeClass('cboxElement');
        }
      });
      // why is the preceeding wrapped in an anonymous function?

      // Site search toggle
      $('#site-search-container-switch').click(function(event){
        if ($('#site-search-container').hasClass('element-invisible')) {
          $('#site-search-container').removeClass('element-invisible');
        } else {
          $('#site-search-container').addClass('element-invisible');
        }
        if ($(this).parent('div').hasClass('search-local')) {
          $('#edit-keys').focus();
        }
        event.stopPropagation();
        event.preventDefault();
      });

      // Superfooter main display toggle
      $('.js__superfooter-trigger').click(function(){
        var h = $('#superfooter > .row').outerHeight();
        if($(this).hasClass('collapsed')) {
          $(this).removeClass('collapsed');
          // TODO: figure out some easing that works in all viewports
          if ($(window).width() > '815') {
            $('#superfooter').animate({'height': h +'px'}, 500, 'swing', function() {
              window.scroll(0, $('#superfooter').offset().top, { behavior: 'smooth' });
            });
          } else {
            $('#superfooter').removeClass('collapsible');
          }
        } else {
          $(this).addClass('collapsed');
          // TODO: figure out some easing that works in all viewports
          if ($(window).width() > '815') {
            $('#superfooter').animate({ height: "0" }, 500, 'swing');
          } else {
            $('#superfooter').addClass('collapsible');
          }
        }
        return false;
      });

      // Superfooter links toggle
      $('.superfooter-resource-links .title').click(function(){
        if($(this).next().is('ul')){
          $(this).next().toggle();
          if ($(this).hasClass('open')){
            $(this).removeClass('open').addClass('closed');
          } else {
            $(this).removeClass('closed').addClass('open');
          }
          return false;
        }
        return true;
      });

      // Make menu headers non-linked and duplicate into menu
      $('nav ul.menu li.expanded a[data-toggle="dropdown"]').each(function(i, el) {
        if ($(el).attr('href') !== void 0) {
          var li = $('<li class="first expanded"><a href="' + $(el).attr('href') + '" title="' + $(el).attr('title') + '">' + $(el).text() + '</a></li>');
          $(el).siblings('ul').prepend(li);
        }
      });
    }
  };
})(jQuery);
