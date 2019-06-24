<?php

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function gt_form_system_theme_settings_alter(&$form, &$form_state) {

  /**
   * Hiding basic theme settings options via CSS (logo, main menu, etc.)
   * (We would just keep these out via the theme info file,
   * but there is currently a bug w/ the logo and favicon upload fields,
   * so it's easier to just hide them with CSS.)
   */
  // Hiding basic settings (main menu, secondary logo, etc.)
  $form['theme_settings']['#attributes'] = array('class' => array('element-hidden'));

  // Hiding favicon options
  $form['favicon']['#attributes'] = array('class' => array('element-hidden'));

  // Hiding default logo options
  $form['logo']['#attributes'] = array('class' => array('element-hidden'));

  /**
   * GT Logo Options
   *
   * $form['gt_logo'] = array(
  '#type' => 'fieldset',
  '#title' => t('Georgia Tech Logo Options'),
  '#description' => t('<p><strong>Use these options select your site\'s Georgia Tech logo treatment. For more information regarding Georgia Tech website branding requirements please <a href="http://www.comm.gatech.edu/resources/web/development/styles">visit the website resources section of the Institute Communications website.</a></strong></p>'),
  );

  $form['gt_logo']['gt_logo_default'] = array(
  '#type' => 'checkbox',
  '#title' => t('Use a Georgia Tech logo listed below.'),
  '#default_value' => theme_get_setting('gt_logo_default'),
  '#description' => t('Check this option to use one of the Georgia Tech logos listed below. Uncheck this box to upload a different Georgia Tech logo.'),
  );
  // Default logo options
  $form['gt_logo']['gt_logo_settings']['#type'] = 'container';
  $form['gt_logo']['gt_logo_settings']['#states'] = array('invisible' => array('input[name="gt_logo_default"]' => array('checked' => FALSE)));
  $form['gt_logo']['gt_logo_settings']['gt_logo_type']['#type'] = 'radios';
  $form['gt_logo']['gt_logo_settings']['gt_logo_type']['#title'] = t('Georgia Tech Logo Option');
  $form['gt_logo']['gt_logo_settings']['gt_logo_type']['#description'] = t('Select a Georgia Tech logo to use on this site.');
  $form['gt_logo']['gt_logo_settings']['gt_logo_type']['#default_value'] = theme_get_setting('gt_logo_type');
  $form['gt_logo']['gt_logo_settings']['gt_logo_type']['#options'] = array(
  0 => t('Primary Georgia Tech Logo (site default)'),
  1 => t('Georgia Tech - College of Design'),
  2 => t('Georgia Tech - College of Computing'),
  3 => t('Georgia Tech - College of Engineering'),
  4 => t('Georgia Tech - College of Sciences'),
  5 => t('Georgia Tech - Ivan Allen College of Liberal Arts'),
  6 => t('Georgia Tech - Scheller College of Business'),
  );
  // Logo file upload
  $form['gt_logo']['gt_logo_upload']['#type'] = 'container';
  $form['gt_logo']['gt_logo_upload']['#states'] = array('invisible' => array('input[name="gt_logo_default"]' => array('checked' => TRUE)));
  $form['gt_logo']['gt_logo_upload']['gt_logo_upload_file'] = array(
  '#type' => 'managed_file',
  '#title' => t('Georgia Tech Logo Upload'),
  '#description' => t('Use this field to upload a Georgia Tech logo. Logo files must be in .png/.gif/.svg format, 90 pixels tall and between 188 - 700 pixels wide. <em>Uploaded images that are larger than these dimensions will be resized proportionally and may produce undesirable results.</em> <a href="http://www.comm.gatech.edu/resources/web/development/styles">Contact Institute Communications</a> for support with generating official Georgia Tech logos.'),
  '#required' => FALSE,
  '#upload_location' => file_default_scheme() . '://gt_theme_files',
  '#default_value' => theme_get_setting('gt_logo_upload_file'),
  '#upload_validators' => array(
  'file_validate_extensions' => array('png svg gif'),
  'file_validate_image_resolution' => array('700x90', '188x90'),
  ),
  );
  $form['gt_logo']['gt_logo_upload']['logo_url'] = array(
  '#type' => 'textfield',
  '#title' => t('Logo URL'),
  '#default_value' => theme_get_setting('logo_url'),
  '#description' => t('If desired, enter a URL for your logo. This will make the right side of the logo link to the URL you enter here. The left side, which contains the "Georgia Tech" wordmark, will link to www.gatech.edu by default. Enter your URL as a global path (i.e., "http://www.mysite.gatech.edu"). If no URL is provided only the "Georgia Tech" portion of the logo will be an active link.'),
  );
   */


  /**
   * Site Skin Options
   *
   *  $form['gt_style_version'] = array(
  '#type' => 'fieldset',
  '#title' => t('Styling Version'),
  '#description' => t('<p><strong>NEW as of version
  2.5!</strong> Select a style version for your site. You
  can go with the default, which is reflects the Georgia
  Tech website styling from versions 2.4 and before, or
  select the new option available with version 2.5.
  Details on the changes in the latest version are
  documented in the <strong><a
  href="' . base_path() . drupal_get_path('theme', 'gt') . '/CHANGELOG.txt">CHANGELOG.txt</a></strong> file.</p>'),
  );
  $form['gt_style_version']['style_selection'] = array(
  '#type' => 'radios',
  '#title' => t('Site Style Version'),
  '#default_value' => theme_get_setting('style_selection'),
  '#options' => array(
  'gt-theme-style-2-4' => t('GT Theme Version 2.4'),
  'gt-theme-style-2-5' => t('GT Theme Version 2.5')
  ),
  );
   *
   */


  /**
   * Site title options
   */
  $form['site_title'] = array(
    '#type' => 'fieldset',
    '#title' => t('Site Header Title Settings'),
    '#description' => t('<p><strong>The text provided here will appear in the site header, to the right of the main logo.</strong></p>'),
  );
  $form['site_title']['site_title_line_1'] = array(
    '#type' => 'textfield',
    '#title' => t('Site Header Title - Line One'),
    '#default_value' => theme_get_setting('site_title_line_1'),
    '#description' => t('If you want to control how the site header title breaks over two lines, you can enter text into the Site Title - Line Two field.'),
  );
  $form['site_title']['site_title_line_2'] = array(
    '#type' => 'textfield',
    '#title' => t('Site Title - Line Two'),
    '#default_value' => theme_get_setting('site_title_line_2'),
    '#description' => t('Use this field to help control how the site header title breaks over two lines.'),
  );

  /**
   * Home page title option
   */
  $form['home_page_title'] = array(
    '#type' => 'fieldset',
    '#title' => t('Home Page Title Settings'),
  );
  $form['home_page_title']['front_page_title_hide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide the page title on the home page?'),
    '#default_value' => theme_get_setting('front_page_title_hide'),
    '#description' => t('Check this option if you would like to have the default <strong>page</strong> title hidden on the home page of your site (<em>the text will still be available for SEO purposes.</em>)'),
  );



  /**
   * Breadcrumb option
   */
  $form['breadcrumb_option'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb Option'),
    '#description' => t('<p><strong>By default the breadcrumb will
    list a link back to the main Georgia Tech site homepage
    first. If you\'d like to have another default link
    always appear after the Georgia Tech link use the fields
    below.</strong></p>'),
  );
  $form['breadcrumb_option']['breadcrumb_option_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb link title'),
    '#default_value' => theme_get_setting('breadcrumb_option_title'),
    '#description' => t('Provide the title for the breadcrumb link.'),
  );
  $form['breadcrumb_option']['breadcrumb_option_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb link URL'),
    '#default_value' => theme_get_setting('breadcrumb_option_link'),
    '#description' => t('Provide the URL for the breadcrumb link. Enter your URL as a global path (i.e., "http://www.mysite.gatech.edu").'),
  );
  $form['breadcrumb_option']['breadcrumb_remove'] = array(
        '#type' => 'checkbox',
        '#title' => t('Remove the breadcrumb?'),
        '#default_value' => theme_get_setting('breadcrumb_remove'),
        '#description' => t('Check this option if you would like to remove the breadcrumb completely.'),
    );

  /**
   * Super Footer Options
   */
  $form['super_footer_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer and SuperFooter Settings'),
    '#description' => t('<p><strong>Use these options customize your site\'s Footer and Super footer, including the menus available in the super footer, the map image (and custom link for that image), and street address.</strong></p>'),
  );
  $form['super_footer_settings']['superfooter_setup'] = array(
    '#type' => 'radios',
    '#title' => t('Super Footer Menus Setup'),
    '#default_value' => theme_get_setting('superfooter_setup'),
    '#options' => array(
      'gt-default-full' => t('Full Georgia Tech Default'),
      'gt-default-mini' => t('Georgia Tech Minimum'),
      'configurable' => t('Configurable'),
    ),
    '#description' => t('The <strong>Full Georgia Tech Default</strong> option will give you the exact same set of super footer menus that appear on the home page of <a href="http://www.gatech.edu">www.gatech.edu</a>. The <strong>Georgia Tech Minimum</strong> option will give you just the menu from the left column in the super footer of the home page at <a href="http://www.gatech.edu">www.gatech.edu</a>, but the menu will be broken up into four shorter menus. The <strong>Configurable</strong> option allows you to have three fully configurable menus in your site\'s super footer.'),
  );
  $form['super_footer_settings']['superfooter_collapsible'] = array(
    '#type' => 'checkbox',
    '#title' => t('Collapse the super footer?'),
    '#default_value' => theme_get_setting('superfooter_collapsible'),
    '#description' => t('Check this option if you would like to have the super footer collapsed by default. If this option is checked a "Resources" tab will appear above the lower footer, which serves as an open/close trigger for the super footer.'),
  );
  $form['super_footer_settings']['map_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use the default Georgia Tech campus map image in the footer.'),
    '#default_value' => theme_get_setting('map_default'),
    '#description' => t('Check this option to use the default Georgia Tech campus map image in the footer of your site. Uncheck this box to upload a custom image.'),
  );
  $form['super_footer_settings']['map_image']['#type'] = 'container';
  $form['super_footer_settings']['map_image']['#states'] = array('invisible' => array('input[name="map_default"]' => array('checked' => TRUE)));
  $form['super_footer_settings']['map_image']['map_upload_file'] = array(
    '#type' => 'managed_file',
    '#title' => t('Map Image Upload'),
    '#description' => t('Use this field to upload a custom map image. Images must be in .png, .gif, or .jpg format, and 370 pixels wide by 200 pixels tall. <em>Uploaded images that are larger than these dimensions will be scaled down and may produce undesirable results.</em>'),
    '#required' => FALSE,
    '#upload_location' => file_default_scheme() . '://gt_theme_files',
    '#default_value' => theme_get_setting('map_upload_file'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
      'file_validate_image_resolution' => array('370x200', '370x200'),
    ),
  );
  $form['super_footer_settings']['map_image']['map_image_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Map Image Link'),
    '#default_value' => theme_get_setting('map_image_link'),
    '#description' => t('Provide a full URL (i.e., http://www.gatech.edu) for your custom map image.'),
  );
  $form['super_footer_settings']['street_address'] = array(
    '#type' => 'textarea',
    '#title' => t('Custom Street Address '),
    '#description' => t('Provide a custom street address which will appear with the campus map image in the footer.'),
    '#default_value' => theme_get_setting('street_address'),
  );

  /**
   * SuperFooter login link options
   */
  $form['super_footer_settings']['superfooter_remove'] = array(
    '#type' => 'checkbox',
    '#title' => t('Remove the super footer?'),
    '#default_value' => theme_get_setting('superfooter_remove'),
    '#description' => t('Check this option if you would like to remove the super footer completely.'),
  );

    /**
     * Login Link option
     */
    $form['super_footer_settings']['login_remove'] = array(
        '#type' => 'checkbox',
        '#title' => t('Remove the login in the footer?'),
        '#default_value' => theme_get_setting('login_remove'),
        '#description' => t('Check this option if you would like to remove the login in the footer completely.'),
    );

  /** Post processing */
  $form['#submit'][] = 'gt_settings_submit';
}

function gt_settings_submit($form, $form_state) {
  global $user;
  // Load the file via file.fid.
  // $files['gt_logo'] = file_load($form_state['values']['gt_logo_upload_file']);
  $files['map'] = file_load($form_state['values']['map_upload_file']);
  foreach ($files as $key => $file) {
    if ($file) {
      // Change status to permanent.
      $file->status = FILE_STATUS_PERMANENT;
      // Save.
      file_save($file);
      // Save file to variable
      variable_set($key . '_fid', $file->fid);
      // Record that the module (in this example, user module) is using the file.
      file_usage_add($file, 'user', 'user', $user->uid);
      // Unset formstate value
      unset($form_state['values'][$key . '_upload_file']); // make sure it is unset for system submit
    }
  }
}
