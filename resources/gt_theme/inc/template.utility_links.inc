<?php

/**
 * @file
 * Markup configuration options for the utility links based on theme settings.
 */
$utility_links_content = '
  <nav id="utility-links" role="navigation" aria-label="Georgia Tech Campus Information Links">
    <ul class="menu">
      <li class="mothership ulink"><a href="http://www.gatech.edu" title="Main campus web site for Georgia Tech ">Georgia Tech Home</a></li>
      <li class="campus-map ulink"><a href="http://map.gatech.edu" title="Campus Map for Georgia Tech">Campus Map</a></li>
      <li class="directories ulink"><a href="' . $variables['directory_url'] . '" title="Locate faculty, staff, and students at Georgia Tech">Directory</a></li>
      <li class="offices ulink"><a href="http://www.gatech.edu/offices-and-departments" title="List of Offices and Departments at Georgia Tech">Offices</a></li>
    </ul>
  </nav>';
