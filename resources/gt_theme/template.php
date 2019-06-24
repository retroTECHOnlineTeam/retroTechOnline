<?php

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 */

/**
 * Override or insert variables into the html templates.
 *
 */
function gt_preprocess_html(&$variables) {
  $variables['user_data'] = $variables['user'];
// Adding user roles as body classes
  $user_data = $variables['user'];
  if ($user_data->uid >= 1) {
    foreach ($user_data->roles as $k => $v) {
      $variables['classes_array'][] = 'user-role-' . drupal_html_class(strtolower($v));
    }
    if ($user_data->uid == 1) {
      $variables['classes_array'][] = 'user-role-god';
    }
  }
  else {
    $variables['classes_array'][] = 'user-role-anonymous';
  }

// Hide front page title based on theme settings
  $front_page_title_hide = theme_get_setting('front_page_title_hide');
  if (in_array('front', $variables['classes_array']) && $front_page_title_hide) {
    $variables['classes_array'][] = 'front-page-title-hidden';
  }


// Styling version variable
  $gt_styling_version = theme_get_setting('style_selection');
  $variables['gt_styling_version'] = $gt_styling_version;

// Adding Font Awesome via CDN
  drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'external');

// Adding Bootstrap 4 CSS via CDN
  drupal_add_css('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', 'external');

// Adding Bootstrap JS via CDN
  drupal_add_js('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js', array('type' => 'external', 'scope' => 'header'));
  drupal_add_js('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array('type' => 'external', 'scope' => 'header'));

// adding Roboto Google fonts
  drupal_add_css('https://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,500,500italic,700,700italic', 'external');
  drupal_add_css('https://fonts.googleapis.com/css?family=Roboto+Slab:400,700', 'external');
  drupal_add_css('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700', 'external');
  drupal_add_css('https://fonts.googleapis.com/css?family=Abel', 'external');
}

/**
 * Alter Search form to make it more accessible.
 */
function gt_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_form') {

    /*
     * Sample values not to override or use
      $form['#attributes']['class'][] = 'search-form';
      $form['basic']['#attributes']['class'] = array(
      'container-inline',
      );
     */

    $prompt = t('Enter your keywords');
    $keys = '';

    /* Input label styles */
    $form['basic']['keys']['#title'] = $prompt;
    $form['basic']['keys']['#title_display'] = 'invisible';
    $form['basic']['keys']['#attributes']['aria-label'][] = 'Search form box';

    /* Input box styles */
    $form['basic']['keys']['#attributes']['class'] = array(
      'element-focusable',
    );
    $form['basic']['keys']['#default_value'] = $keys;
    $form['basic']['keys']['#size'] = $prompt ? 40 : 20;
    $form['basic']['keys']['#maxlength'] = 150;

    /* Submit button styles */
    $form['basic']['submit']['#value'] = t('Search Button');
    $form['basic']['submit']['#attributes']['class'] = array(
      'element-invisible',
      'element-focusable',
    );
  }
}

/**
 * Override or insert variables into the page templates.
 *
 * @TODO: gt_tools check doesn't work properly with overlay turned on.
 */
function gt_preprocess_page(&$variables) {

// Use of GT Tools module is mandatory. Otherwise everything will break.
  if (!module_exists('gt_tools')) {
    variable_set('theme_default', 'bartik');
    drupal_get_messages();
    drupal_set_message(
        t("Sorry! You'll need to !enable before you can use the GT Theme.", array('!enable' => l('enable the GT Tools module', 'admin/modules'))), 'error');
    drupal_goto($_GET['q']);
    return;
  }

// Theme path variable
  $variables['theme_path'] = base_path() . drupal_get_path('theme', 'gt');

// Main menu
  $main_menu_choice = variable_get('menu_main_links_source', 'main-menu');
  $main_menu_output = menu_tree_output(menu_tree_all_data($main_menu_choice));
  $variables['primary_main_menu'] = render($main_menu_output);
  $variables['primary_main_menu_manage'] = l(t('Manage Links'), 'admin/structure/menu/manage/' . $main_menu_choice, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'populated'), 'title' => 'Manage Links'),));

// GT Tools menus variables
// social media links
  $variables['social_media_links'] = menu_navigation_links('gt-social-media');
  foreach ($variables['social_media_links'] as &$link) {
    $link['attributes']['class'][] = str_replace(' ', '', strtolower($link['title']));
  }

  $variables['social_media_links_manage'] = l(t('Manage Links'), 'admin/structure/menu/manage/gt-social-media', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'populated'), 'title' => 'Manage Links'),));
  $variables['social_media_links_add'] = l(t('Add Social Media Links Here'), 'admin/structure/menu/manage/gt-social-media', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'empty'),),));

// action items links
  $variables['action_items'] = menu_navigation_links('gt-action-items');
  $variables['action_items_manage'] = l(t('Manage Links'), 'admin/structure/menu/manage/gt-action-items', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'populated'), 'title' => 'Manage Links'),));
  $variables['action_items_add'] = l(t('Add Action Links Here'), 'admin/structure/menu/manage/gt-action-items', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'empty'),),));

// remove breadcrumb */
    $breadcrumb_remove_trigger = theme_get_setting('breadcrumb_remove');
    $variables['breadcrumb_remove'] = ($breadcrumb_remove_trigger == 1) ? 'breadcrumb-removed' : '';

// footer and footer resources links */
  $login_remove_trigger = theme_get_setting('login_remove');
  $variables['login_remove'] = ($login_remove_trigger == 1) ? 'login-removed' : '';

// superfooter and footer resources links */
  $variables['superfooter_setup'] = theme_get_setting('superfooter_setup');
  $superfooter_collapsible_trigger = theme_get_setting('superfooter_collapsible');
  $superfooter_remove_trigger = theme_get_setting('superfooter_remove');
  $variables['superfooter_collapsible'] = ($superfooter_collapsible_trigger == 1) ? 'superfooter-collapsed' : '';
  $variables['superfooter_remove'] = ($superfooter_remove_trigger == 1) ? 'superfooter-removed' : '';

  for ($i = 1; $i < 4; $i++) {
    $footer_links[$i]['links'] = menu_navigation_links('gt-footer-links-' . $i);
    $footer_links[$i]['info'] = menu_load('gt-footer-links-' . $i);
    $variables['footer_links_' . $i] = theme('links', array(
      'links' => $footer_links[$i]['links'],
      'attributes' => array(
        'class' => array('menu'),
      ),
      'heading' => array(
        'text' => t($footer_links[$i]['info']['title']),
        'level' => 'h4',
        'class' => array('title'),
      ),
    ));
    $variables['footer_links_' . $i . '_manage'] = l(t('Manage Links'), 'admin/structure/menu/manage/gt-footer-links-' . $i, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'populated'), 'title' => 'Manage Links'),));
    $variables['footer_links_' . $i . '_add'] = l(t('Add Resource Links Here'), 'admin/structure/menu/manage/gt-footer-links-' . $i, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'empty'),),));
  }

// footer utility links */
  $footer_ulinks_links = menu_navigation_links('gt-footer-utility-links');
  $variables['footer_ulinks'] = theme('links', array(
    'links' => $footer_ulinks_links,
    'attributes' => array(
      'class' => array('menu', 'gt-footer-utility-links'),
    ),
  ));
  $variables['footer_ulinks_manage'] = l(t('Manage Links'), 'admin/structure/menu/manage/gt-footer-utility-links', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'populated'), 'title' => 'Manage Links'),));
  $variables['footer_ulinks_add'] = l(t('Add Footer Utility Links Here'), 'admin/structure/menu/manage/gt-footer-utility-links', array('query' => drupal_get_destination(), 'attributes' => array('class' => array('gt-tools-contextual-link', 'empty'),),));

// GT Logo variable
  $logo_default_flag = theme_get_setting('gt_logo_default');
  $logo_upload_fid = theme_get_setting('gt_logo_upload_file');
  $logo_upload_url = theme_get_setting('logo_url');
  if ($logo_upload_fid != '' && $logo_default_flag == '' && $logo_upload_file = file_load($logo_upload_fid)) {
    $logo_upload_file_url = file_create_url($logo_upload_file->uri);
    $variables['gt_logo_file'] = '<img alt="' . $variables['site_name'] . '" class="uploaded-logo-file" src="' . $logo_upload_file_url . '" />';
    if ($logo_upload_url != '') {
      $variables['gt_logo_right_url'] = $logo_upload_url;
      $variables['gt_logo_right_title'] = $variables['site_name'];
    }
    else {
      $variables['gt_logo_right_url'] = '';
      $variables['gt_logo_right_title'] = '';
    }
  }
  else {
    $gt_logo_selection = theme_get_setting('gt_logo_type');
    switch ($gt_logo_selection) {
      case 0:
        $variables['gt_logo_file'] = '<img class="gt-logo-svg" alt="Georgia Tech" src="' . $variables['theme_path'] . '/images/logos/logo-gt.png" />';
        $variables['gt_logo_right_url'] = '';
        $variables['gt_logo_right_title'] = '';
        break;
      case 1:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | College of Design" src="' . $variables['theme_path'] . '/images/logos/logo-gt-cod.png" />';
        $variables['gt_logo_right_url'] = 'http://www.design.gatech.edu';
        $variables['gt_logo_right_title'] = 'College of Design';
        break;
      case 2:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | College of Computing" src="' . $variables['theme_path'] . '/images/logos/logo-gt-coc.png" />';
        $variables['gt_logo_right_url'] = 'http://www.cc.gatech.edu';
        $variables['gt_logo_right_title'] = 'College of Computing';
        break;
      case 3:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | College of Engineering" src="' . $variables['theme_path'] . '/images/logos/logo-gt-coe.png" />';
        $variables['gt_logo_right_url'] = 'http://www.coe.gatech.edu';
        $variables['gt_logo_right_title'] = 'College of Engineering';
        break;
      case 4:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | College of Sciences" src="' . $variables['theme_path'] . '/images/logos/logo-gt-cos.png" />';
        $variables['gt_logo_right_url'] = 'http://www.cos.gatech.edu';
        $variables['gt_logo_right_title'] = 'College of Sciences';
        break;
      case 5:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | Ivan Allen College of Liberal Arts" src="' . $variables['theme_path'] . '/images/logos/logo-gt-iac.png" />';
        $variables['gt_logo_right_url'] = 'http://www.iac.gatech.edu';
        $variables['gt_logo_right_title'] = 'Ivan Allen College of Liberal Arts';
        break;
      case 6:
        $variables['gt_logo_file'] = '<img alt="Georgia Tech | Scheller College of Business" src="' . $variables['theme_path'] . '/images/logos/logo-gt-scheller.png" />';
        $variables['gt_logo_right_url'] = 'http://www.scheller.gatech.edu';
        $variables['gt_logo_right_title'] = 'Scheller College of Business';
        break;
      default:
        $variables['gt_logo_file'] = '<img class="gt-logo-svg" alt="Georgia Tech" src="' . $variables['theme_path'] . '/images/logos/logo-gt.png" />';
    }
  }

// Site title and site title class variables
  $site_title_line_1 = theme_get_setting('site_title_line_1');
  $site_title_line_2 = theme_get_setting('site_title_line_2');
  if ($site_title_line_1 != '') {
    if ($site_title_line_2 != '') {
      $variables['site_title_class'] = 'two-line';
      $variables['site_title'] = $site_title_line_1 . '<h3 class="site-slogan">' . $site_title_line_2 .'</h3>';
    }
    else {
      $variables['site_title_class'] = 'one-line';
      $variables['site_title'] = $site_title_line_1;
    }
  }
  else {
    $variables['site_title'] = '';
  }

  /*
   * Search form for use in page.tpl.php
   */
  if (module_exists('search')) {
    $search_form = drupal_get_form('search_form');
    $search_form_output = drupal_render($search_form);
    $variables['search_page'] = '<div id="search-local" role="search"><h2 class="element-invisible">Search form</h2>' . $search_form_output . '</div>';
  }
  else {
    $variables['search_page'] = NULL;
  }

  // sidebar indicator classes for main content area
  $variables['content_class'] = 'no-sidebars';
  if (!empty($variables['page']['left']) || !empty($variables['page']['left_nav'])) {
    $variables['content_class'] = 'sidebar-left one-sidebar';
    $variables['sidebar_right_class'] = 'with-sidebar-left';
  }
  else {
    $variables['sidebar_right_class'] = 'solo-sidebar';
  }
  if (!empty($variables['page']['right'])) {
    $variables['content_class'] = ($variables['content_class'] == 'sidebar-left one-sidebar') ? 'both-sidebars' : 'sidebar-right one-sidebar';
    $variables['sidebar_left_class'] = 'with-sidebar-right';
  }
  else {
    $variables['sidebar_left_class'] = 'solo-sidebar';
  }

  // Footer map image variable
  $map_fid = theme_get_setting('map_upload_file');
  if ($map_fid != '') {
    $map_upload_file = file_load($map_fid);
    $map_upload_file_url = file_create_url($map_upload_file->uri);
    $variables['footer_map_image_file'] = '<img alt="Map of ' . $variables['site_name'] . '" class="uploaded-map-image-file" src="' . $map_upload_file_url . '" />';
  }
  else {
    $variables['footer_map_image_file'] = '<img alt="Map of Georgia Tech" src="' . $variables['theme_path'] . '/images/gt-map-image-default.jpg" />';
  }
  $map_custom_link = theme_get_setting('map_image_link');
  $variables['map_image'] = $map_custom_link != '' ? l($variables['footer_map_image_file'], $map_custom_link, array('html' => TRUE)) : l($variables['footer_map_image_file'], 'http://map.gatech.edu', array('html' => TRUE));

  // Street address
  $street_address = theme_get_setting('street_address');
  $variables['street_address'] = $street_address != '' ? check_markup($street_address) : '<p>Georgia Institute of Technology<br />North Avenue, Atlanta, GA 30332<br />Phone: <span class="phone-id">404-894-2000</span></p>';

  // Footer login link flag variable
  $variables['footer_login_link'] = theme_get_setting('login_link_option');

  // Footer Redirect on Login link flag variable
  $variables['footer_login_redirect_option'] = theme_get_setting('login_redirect_option');

  // Footer Login Alternative URL text variables
  $alt_url = check_plain(theme_get_setting('login_alt_base_url'));
  $variables['footer_login_base_url'] = filter_var($alt_url, FILTER_VALIDATE_URL) ? $alt_url : '';

  // Directory URL variable
  $variables['directory_url'] = module_exists('gt_directory') ? '/directory' : 'http://www.directory.gatech.edu';
}

/*
 * Runs after ALL preprocess functions have run.
 *
 */

function gt_process_page(&$variables) {
  // include utility links content
  require(drupal_get_path('theme', 'gt') . '/inc/template.utility_links.inc');
  $variables['utility_links_content'] = $utility_links_content;
  // include superfooter content
  require(drupal_get_path('theme', 'gt') . '/inc/template.superfooter.inc');
  $variables['superfooter_content'] = $superfooter_content;
  // include footer content
  require(drupal_get_path('theme', 'gt') . '/inc/template.footer.inc');
  $variables['footer_content'] = $footer_content;
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 *
 */
function gt_menu_local_tasks(&$variables) {
  $output = '';
  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node templates.
 *
 */
function gt_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  require(drupal_get_path('theme', 'gt') . '/inc/template.gt_tools_content_types.inc');
}

/**
 * Adding a block count class to the region.
 *
 */
function gt_preprocess_region(&$variables) {
  $variables['classes_array'][] = 'block-count' . min(count(block_list($variables['region'])), 4);
  $variables['classes_array'][] = 'clearfix';
}

/**
 * Override or insert variables into the block templates.
 *
 */
function gt_preprocess_block(&$variables) {
  // Adding region weight (placement) class
  $variables['classes_array'][] = 'block-region-weight-' . $variables['elements']['#weight'];

  // Adding row limit break classes
  $region_ordinal_weight = ($variables['elements']['#weight'] - 1);
  if ($region_ordinal_weight != 0) {
    for ($i = 2; $i < 5; $i++) {
      if ($region_ordinal_weight % $i == 0) {
        $variables['classes_array'][] = 'row-limit-' . $i . '-break';
      }
    }
  }

  // Adding zebra striping classes
  $variables['classes_array'][] = $variables['block_zebra'];
}

/**
 * Override of breadcrumb
 *
 */
function gt_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  // Provide a navigational heading to give context for breadcrumb links to
  // screen-reader users. Make the heading invisible with .element-invisible.
  $output = '<li class="element-invisible">' . t('You are here: ') . '</li>';
  // first item is always a link back to the mothership, and it always appears
  $output .= '<li class="breadcrumb-item first">' . l(t('GT Home'), 'http://www.gatech.edu') . '</li>';
  // check for custom settings
  $custom_bc_title = theme_get_setting('breadcrumb_option_title');
  $custom_bc_link = theme_get_setting('breadcrumb_option_link');
  if ($custom_bc_title != '' && $custom_bc_link != '') {
    $output .= '<li class="breadcrumb-item custom-link">' . l(t($custom_bc_title), $custom_bc_link) . '</li>';
  }
  if (!empty($breadcrumb)) {
    $crumb_total = count($breadcrumb);
    $crumb_count = 0;
    foreach ($breadcrumb AS $crumb) {
      $crumb_count++;
      $output .= '<li class="breadcrumb-item';
      if ($crumb_count == $crumb_total) {
        $output .= ' last';
      }
      $output .= '">' . $crumb . '</li>';
    }
  }
  return $output;
}

/**
 * Override of menu link formatting
 *
 */
function gt_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  // adding a unique class for each link
  $element['#attributes']['class'][] = $element['#original_link']['menu_name'] . '-link-' . $element['#original_link']['mlid'];

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
      // overriding default html option of l function since titles will have span tags
      $element['#localized_options']['html'] = TRUE;
      // adding a span tag around link title
      $output = l('<span>' . $element['#title'] . '</span>', $element['#href'], $element['#localized_options']);
      return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
    } else {
      if ($element['#original_link']['p2'] == 0) {
        // Add our own wrapper.
        unset($element['#below']['#theme_wrappers']);
        $sub_menu = '<ul class="dropdown-menu"';
        if (isset($element['#original_link']['mlid'])) { $sub_menu .= ' aria-labelledby="dropdown-' . $element['#original_link']['mlid']; }
        $sub_menu .= '">' . drupal_render($element['#below']) . '</ul>';
        // Generate as standard dropdown.
        $element['#title'] .= ' <span class="caret"></span>';
        $element['#attributes']['class'][] = 'dropdown';
        $element['#localized_options']['html'] = TRUE;
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
        if (isset($element['#original_link']['mlid'])) { $element['#localized_options']['attributes']['id'] = 'dropdown-' . $element['#original_link']['mlid']; }
      } else {
        // Add our own wrapper.
        unset($element['#below']['#theme_wrappers']);
        $sub_menu = '<ul>' . drupal_render($element['#below']) . '</ul>';
      }
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
