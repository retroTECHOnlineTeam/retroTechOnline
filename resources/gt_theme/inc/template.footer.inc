<?php

/**
 * @file
 * Markup configuration options for the footer based on theme settings.
 */
$footer_content = '<footer id="footer">
    <div class="row clearfix">
      <div id="footer-utility-links">
        <div role="navigation" aria-label="Site Utility" class="gt-footer-utility-links-wrapper';
if ($variables['footer_login_link']) {
  $footer_content .= ' login-link-included';
}
$footer_content .= '">';
if ($variables['footer_ulinks']) {
  $footer_content .= $variables['footer_ulinks'];
  if ($variables['is_admin']) {
    $footer_content .= $variables['footer_ulinks_manage'];
  }
}
else {
  if ($variables['is_admin']) {
    $footer_content .= $variables['footer_ulinks_add'];
  }
}
$footer_content .= '</div>';
$footer_content .= '<div class="gt-footer-legal-links-wrapper" role="navigation" aria-label="Legal">';
$footer_content .= '<ul class="menu gt-footer-legal-links';
if ($variables['footer_ulinks']) {
  $footer_content .= ' custom-links-included';
}
if ($variables['footer_login_link']) {
  $footer_content .= ' login-link-included';
}
$footer_content .='">';
$footer_content .='<li class="first"><a href="https://www.gatech.edu/emergency/">Emergency Information</a></li>';
$footer_content .='<li><a href="https://www.gatech.edu/legal/">Legal &amp; Privacy Information</a></li>';
$footer_content .='<li><a href="https://gbi.georgia.gov/documents/human-trafficking-notice">Human Trafficking Notice</a></li>';
$footer_content .='<li><a href="https://www.gatech.edu/accessibility/">Accessibility</a></li>';
$footer_content .='<li><a href="https://www.gatech.edu/accountability/">Accountability</a></li>';
$footer_content .='<li><a href="https://www.gatech.edu/accreditation/">Accreditation</a></li>';
$footer_content .='<li class="last"><a href="http://www.careers.gatech.edu">Employment</a></li>';
$footer_content .='</ul>';
$footer_content .='</div>';
if ($variables['footer_login_link']) {
  $footer_content .='<div class="gt-footer-login-links-wrapper" role="navigation" aria-label="Log in">';
  $footer_content .='<ul class="menu gt-footer-login-links">';
  $footer_destination = '?destination=' . check_url(current_path());
  $footer_login_url = $variables['footer_login_base_url'];

  /* Log OUT link for authenticated user */
  if ($variables['user']->uid >= 1) {
    if (module_exists('cas')) {
      $footer_content .='<li class="gt-site-logout first"><a href="' . $footer_login_url . '/caslogout" title="Log on out of the site AND end your GT login session">GT Logout</a></li>';
      $footer_content .='<li class="site-logout last"><a href="' . $footer_login_url . '/user/logout" title="Log on out of the site ONLY (GT login session will remain active)">Site Logout</a></li>';
    }
    else {
      $footer_content .='<li class="site-logout first last"><a href="' . $footer_login_url . '/user/logout">Logout</a></li>';
    }
  }
  /* Log IN link for anonymous user */
  else {
    if (module_exists('cas')) {
      if ($variables['footer_login_redirect_option'] == 1) {
        $footer_content .='<li class="gt-site-login first"><a href="' . $footer_login_url . '/cas' . $footer_destination . '">GT Login</a></li>';
        $footer_content .='<li class="site-login last"><a href="' . $footer_login_url . '/user' . $footer_destination . '">Standard Login</a></li>';
      }
      else {
        $footer_content .='<li class="gt-site-login first"><a href="' . $footer_login_url . '/cas">GT Login</a></li>';
        $footer_content .='<li class="site-login last"><a href="' . $footer_login_url . '/user">Standard Login</a></li>';
      }
    }
    else {
      if ($variables['footer_login_redirect_option'] == 1) {
        $footer_content .='<li class="site-login first last"><a href="' . $footer_login_url . '/user' . $footer_destination . '">Login</a></li>';
      }
      else {
        $footer_content .='<li class="site-login first last"><a href="' . $footer_login_url . '/user">Login</a></li>';
      }
    }
  }
  $footer_content .= '</ul>';
  $footer_content .= '</div>';
}
$footer_content .= '</div>';
$footer_content .= '<div id="footer-logo">';
$footer_content .= '<a href="https://www.gatech.edu/"><img alt="Georgia Tech" src="' . $variables['theme_path'] . '/images/logos/gt-logo-footer-retina.png" /></a>';
$footer_content .= '<p>&copy; Georgia Institute of Technology</p>';
$footer_content .= '</div>';
$footer_content .= '</div>';
$footer_content .= '</footer>';
