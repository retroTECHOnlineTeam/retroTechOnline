<?php

/**
 * @file
 * Markup configuration options for the superfooter based on theme settings.
 */
if ($variables['superfooter_remove'] != 'superfooter-removed') {

// collapsible trigger
  if ($variables['superfooter_collapsible'] != '') {
    $superfooter_content = '<div class="superfooter-trigger-wrapper clearfix"><a class="js__superfooter-trigger collapsed" href="#superfooter" id="superfooter-trigger">Resources</a></div>';
  }
  else {
    $superfooter_content = '';
  }

// Superfooter section/wrapper markup
  $superfooter_content .= '<section id="superfooter" class="superfooter-' . $variables['superfooter_setup'];
  if ($variables['superfooter_collapsible'] != '') {
    $superfooter_content .= ' collapsible';
  }
  $superfooter_content .= '">';
  $superfooter_content .= '<div class="row clearfix">';

// Standard left-row menu
  $superfooter_content .=
      '<div class="superfooter-resource-links" id="gt-default-resource-links" role="navigation" aria-labelledby="gt-default-resource-links-title">
    <h4 class="title" id="gt-default-resource-links-title">Georgia Tech Resources</h4>
    <ul class="menu" id="gt-default-resources">
      <li><a href="https://gatech.edu/offices-and-departments">Offices &amp; Departments</a></li>
      <li><a href="http://news.gatech.edu">News Center</a></li>
      <li><a href="https://gatech.edu/calendar">Campus Calendar</a></li>
      <li><a href="http://specialevents.gatech.edu">Special Events</a></li>
      <li><a href="http://greenbuzz.gatech.edu">GreenBuzz</a></li>
      <li><a href="http://comm.gatech.edu">Institute Communications</a></li>';

// If 'mini' option is selected, break full resources list into resources, and visitor resources
  if ($variables['superfooter_setup'] == 'gt-default-mini') {
    $superfooter_content .= '</ul></div>';
    $superfooter_content .=
        '<div class="superfooter-resource-links" id="gt-default-visitor-links" role="navigation" aria-labelledby="gt-default-visitor-links-title">
      <h4 class="title" id="gt-default-visitor-links-title">Visitor Resources</h4>
      <ul class="menu" id="gt-visitor-resources">';
  }
  else {
    $superfooter_content .= '<li><span class="nolink">Visitor Resources</span></li>';
  }

  $superfooter_content .=
      '<li class="gt-default-mini-left"><a href="http://admission.gatech.edu/visit">Campus Visits</a></li>
    <li class="gt-default-mini-right"><a href="http://admission.gatech.edu/visit/directions-and-parking">Directions to Campus</a></li>
    <li class="gt-default-mini-left"><a href="http://pts.gatech.edu/visitors/Pages/default.aspx">Visitor Parking Information</a></li>
    <li class="gt-default-mini-right"><a href="http://lawn.gatech.edu/gtvisitor">GTvisitor Wireless Network Information</a></li>
    <li class="gt-default-mini-left"><a href="https://pe.gatech.edu/global-learning-center">Georgia Tech Global Learning Center</a></li>
    <li class="gt-default-mini-right"><a href="http://gatechhotel.com">Georgia Tech Hotel &amp; Conference Center</a></li>
    <li class="gt-default-mini-left"><a href="https://gatech.bncollege.com">Barnes &amp; Noble at Georgia Tech</a></li>
    <li class="gt-default-mini-right"><a href="http://ferstcenter.gatech.edu">Ferst Center for the Arts</a></li>
    <li class="gt-default-mini-left"><a href="http://paper.gatech.edu/">Robert C. Williams Paper Museum</a></li>
  </ul>
</div>';

// Standard top-level links for default selection
  if ($variables['superfooter_setup'] == 'gt-default-full') {
    $superfooter_content .= '
  <div id="gt-footer-links-1" class="superfooter-resource-links" role="navigation" aria-labelledby="gt-footer-links-1-title">
    <h4 class="title" id="gt-footer-links-1-title">Colleges, Instructional Sites &amp; Research</h4>
    <ul class="menu">
      <li><span class="nolink">Colleges</span></li>
      <li><a href="https://cc.gatech.edu">College of Computing</a></li>
      <li><a href="https://design.gatech.edu">College of Design</a></li>
      <li><a href="https://coe.gatech.edu">College of Engineering</a></li>
      <li><a href="https://cos.gatech.edu">College of Sciences</a></li>
      <li><a href="https://iac.gatech.edu">Ivan Allen College of Liberal Arts</a></li>
      <li><a href="https://scheller.gatech.edu">Scheller College of Business</a></li>
      <li><span class="nolink">Instructional Sites</span></li>
      <li><a href="http://lorraine.gatech.edu">Georgia Tech-Lorraine</a></li>
      <li><a href="https://pe.gatech.edu/savannah-campus">Georgia Tech-Savannah</a></li>
      <li><a href="http://shenzhen.gatech.edu">Georgia Tech-Shenzhen</a></li>
      <li><a href="https://pe.gatech.edu/georgia-tech-online">Georgia Tech Online</a></li>
      <li><a href="https://pe.gatech.edu">Professional Education</a></li>
      <li><a href="https://esl.gatech.edu/">The Language Institute</a></li>
      <li><span class="nolink">Global Footprint</span></li>
      <li><a href="http://global.gatech.edu">Global Engagement</a></li>
      <li><span class="nolink">Research</span></li>
      <li><a href="http://gtri.gatech.edu">Georgia Tech Research Institute</a></li>
      <li><a href="http://research.gatech.edu">Research at Georgia Tech</a></li>
      <li><a href="http://research.gatech.edu/meet-dr-chaouki-t-abdallah">Executive Vice President for Research</a></li>
    </ul>
  </div>
  <div id="gt-footer-links-2" class="superfooter-resource-links" role="navigation" aria-labelledby="gt-footer-links-2-title">
    <h4 class="title" id="gt-footer-links-2-title">Student &amp; Parent Resources</h4>
    <ul class="menu">
      <li><span class="nolink">Student Resources</span></li>
      <li><a href="https://gatech.edu/admissions">Apply</a></li>
      <li><a href="https://buzzport.gatech.edu/cp/home/displaylogin">BuzzPort</a></li>
      <li><a href="http://buzzcard.gatech.edu">Buzzcard</a></li>
      <li><a href="http://career.gatech.edu">Career Resources</a></li>
      <li><a href="http://commencement.gatech.edu/">Commencement</a></li>
      <li><a href="http://library.gatech.edu">Library</a></li>
      <li><a href="http://studentaffairs.gatech.edu">Student Life</a></li>
      <li><a href="https://gatech.edu/innovation-ecosystem/students">Student Entrepreneurship</a></li>
      <li><a href="http://oie.gatech.edu/study-abroad">Study Abroad</a></li>
      <li><a href="https://canvas.gatech.edu">Canvas</a></li>
      <li><span class="nolink">Parent Resources</span></li>
      <li><a href="http://parents.gatech.edu">Parent and Family Programs</a></li>
      <li><a href="http://studentlife.gatech">Student Life</a></li>
      <li><a href="http://finaid.gatech.edu">Scholarships &amp; Financial Aid</a></li>
    </ul>
  </div>
  <div id="gt-footer-links-3" class="superfooter-resource-links" role="navigation" aria-labelledby="gt-footer-links-3-title">
    <h4 class="title" id="gt-footer-links-3-title">Employee, Alumni, &amp; Other Resources</h4>
    <ul class="menu">
      <li><span class="nolink">Employees</span></li>
      <li><a href="http://af.gatech.edu/">Administration and Finance</a></li>
      <li><a href="http://advising.gatech.edu">Advising &amp; Teaching</a></li>
      <li><a href="http://faculty.gatech.edu">Faculty Affairs</a></li>
      <li><a href="http://careers.gatech.edu">Faculty Hiring</a></li>
      <li><a href="http://ohr.gatech.edu">Human Resources</a></li>
      <li><a href="http://provost.gatech.edu">Office of the Provost</a></li>
      <li><a href="http://techworks.gatech.edu">TechWorks</a></li>
      <li><span class="nolink">Alumni</span></li>
      <li><a href="http://gtalumni.org">Alumni Association</a></li>
      <li><a href="http://gtalumni.org/career">Alumni Career Services</a></li>
      <li><a href="http://gtalumni.org/s/1481/alumni/index.aspx?sid=1481&gid=21&pgid=689">Giving Back to Tech</a></li>
      <li><span class="nolink">Outreach</span></li>
      <li><a href="http://atdc.org">Startup Companies</a></li>
      <li><a href="http://innovate.gatech.edu">Economic Development</a></li>
      <li><a href="http://industry.gatech.edu">Industry Engagement</a></li>
      <li><a href="http://gov.gatech.edu">Government &amp; Community Partners</a></li>
      <li><a href="https://pe.gatech.edu">Professional Education</a></li>
    </ul>
  </div>';
  }

  if ($variables['superfooter_setup'] == 'configurable') {
    $superfooter_content .= '<div class="superfooter-resource-links" id="gt-footer-links-1">';
    if ($variables['footer_links_1']) {
      $superfooter_content .= $variables['footer_links_1'];
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_1_manage'];
      }
    }
    else {
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_1_add'];
      }
    }
    $superfooter_content .= '</div>';

    $superfooter_content .= '<div class="superfooter-resource-links"  id="gt-footer-links-2">';
    if ($variables['footer_links_2']) {
      $superfooter_content .= $variables['footer_links_2'];
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_2_manage'];
      }
    }
    else {
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_2_add'];
      }
    }
    $superfooter_content .= '</div>';

    $superfooter_content .= '<div class="superfooter-resource-links" id="gt-footer-links-3">';
    if ($variables['footer_links_3']) {
      $superfooter_content .= $variables['footer_links_3'];
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_3_manage'];
      }
    }
    else {
      if ($variables['is_admin']) {
        $superfooter_content .= $variables['footer_links_3_add'];
      }
    }
    $superfooter_content .= '</div>';
  }

  $superfooter_content .= '<div id="street-address-info">';
  $superfooter_content .= $variables['map_image'];
  $superfooter_content .= '<div class="street-address">';
  $superfooter_content .= $variables['street_address'];
  $superfooter_content .= '</div></div>';
  $superfooter_content .= '';
  $superfooter_content .= '</div></section>';
}
