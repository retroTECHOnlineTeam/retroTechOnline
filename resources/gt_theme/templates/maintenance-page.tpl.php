<?php
/**
 * @file
 * GT theme's implementation to display a Drupal maintenance page.
 *
 */
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>
    <head profile="<?php print $grddl_profile; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php print $head; ?>
        <title><?php print $head_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php print $styles; ?>
        <?php print $scripts; ?>
        <link rel="stylesheet" href="<?php print base_path() . drupal_get_path('theme', 'gt'); ?>/css/base.css">
        <!--[if lte IE 8]>
          <style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/css/ie.css";</style>
        <![endif]-->
    </head>
    <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
        <!--[if IE 7]><div class="ie-smells-wrapper ie7"><![endif]-->
        <!--[if IE 8]><div class="ie-smells-wrapper ie8"><![endif]-->
        <!--[if IE 9]><div class="ie-smells-wrapper ie9"><![endif]-->
        <p id="skip-links" class="element-invisible">
            <a href="#main" class="element-invisible element-focusable">Skip to content</a>
        </p>

        <div id="page">

            <header id="masthead">

                <section id="identity">
                    <div id="identity-wrapper" class="clearfix">
                        <h1 id="gt-logo">
                            <a href="<?php print $front_page; ?>" rel="home" title="Georgia Institute of Technology" ><img src="/sites/all/themes/gt/images/logos/logo-gt.png" alt="Georgia Tech"></a>
                        </h1>
                        <?php if ($site_title != '') : ?>
                          <h2 class="<?php print $site_title_class; ?>" id="site-title" rel="home"><a href="<?php print $front_page; ?>"><?php print $site_title; ?></a></h2>
                        <?php endif; ?>
                    </div>
                </section><!-- /#identity -->

                <section id="primary-menus">
                    <div id="primary-menus-wrapper" class="clearfix">
                        <a id="primary-menus-toggle" class="hide-for-desktop"><span>Menu</span></a>
                        <div id="primary-menus-off-canvas" class="off-canvas">
                            <a id="primary-menus-close" class="hide-for-desktop"><span>Close</span></a>
                            <nav>
                                <div id="main-menu-wrapper"> </div>
                                <div id="action-items-wrapper"> </div>
                            </nav>
                            <div id="utility">
                                <div class="row clearfix">
                                    <nav id="utility-links">
                                        <ul class="menu">
                                            <li class="mothership ulink"><a href="http://www.gatech.edu" title="Georgia Tech Home">Georgia Tech Home</a></li>
                                            <li class="campus-map ulink"><a href="http://map.gatech.edu" title="Campus Map">Map</a></li>
                                            <li class="directories ulink"><a href="/directory" title="Campus Directory">Directory</a></li>
                                            <li class="offices ulink"><a href="/offices-and-departments" title="Office">Offices</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div><!-- /#utility -->
                        </div>
                </section><!-- /#primary-menus -->
            </header><!-- /#masthead -->

            <section id="main">
                <div class="row clearfix">

                    <?php print render($title_prefix); ?>
                    <?php if ($title): ?>
                      <div id="page-title">
                          <h2 class="title"><?php print $title; ?></h2>
                      </div>
                    <?php endif; ?>
                    <?php print render($title_suffix); ?>

                    <?php
                    // Check for content lead/close and left_nav
                    $content_lead = render($page['content_lead']);
                    $content_close = render($page['content_close']);
                    ?>

                    <div id="content-lead">
                        <?php print $content_lead; ?>
                    </div>

                    <div class="<?php print $content_class; ?>" id="content">
                        <?php
                        // Check for content page help and tabs
                        $page_help = render($page['help']);
                        $page_tabs = render($tabs);
                        ?>

                        <?php if ($messages || $page_help || $page_tabs || $action_links) : ?>
                          <div id="support">
                              <?php print $messages; ?>
                              <?php print render($page['help']); ?>
                              <?php print render($tabs); ?>
                              <?php if ($action_links) : ?>
                                <ul class="action-links">
                                    <?php print render($action_links); ?>
                                </ul>
                              <?php endif; ?>
                          </div>
                        <?php endif; ?>
                        <div class="block"><?php print $content; ?></div>
                        <?php print $feed_icons; ?>
                    </div><!-- /#content -->


                    <aside id="sidebar-right">

                    </aside>

                    <div id="content-close">

                    </div>

                </div>
            </section><!-- /#main -->

            <section id="superfooter" class="superfooter-gt-default-mini">
                <div class="row clearfix">

                    <div class="superfooter-resource-links" id="gt-default-resource-links">
                        <h4 class="title">Georgia Tech Resources</h4>
                        <ul class="menu" id="gt-default-resources">
                            <li><a href="http://www.gatech.edu/offices-and-departments">Offices &amp; Departments</a></li>
                            <li><a href="http://www.news.gatech.edu">News Center</a></li>
                            <li><a href="http://www.gatech.edu/calendar">Campus Calendar</a></li>
                            <li><a href="http://www.specialevents.gatech.edu">Special Events</a></li>
                            <li><a href="http://www.greenbuzz.gatech.edu">GreenBuzz</a></li>
                            <li><a href="http://www.comm.gatech.edu">Institute Communications</a></li>
                        </ul>
                    </div>
                    <div class="superfooter-resource-links" id="gt-default-visitor-links">
                        <h4 class="title">Visitor Resources</h4>
                        <ul class="menu" id="gt-visitor-resources">
                            <li class="gt-default-mini-left"><a href="http://www.admission.gatech.edu/visit">Campus Visits</a></li>
                            <li class="gt-default-mini-right"><a href="http://www.admission.gatech.edu/visit/directions-and-parking">Directions to Campus</a></li>
                            <li class="gt-default-mini-left"><a href="http://www.pts.gatech.edu/visitors/Pages/default.aspx">Visitor Parking Information</a></li>
                            <li class="gt-default-mini-right"><a href="http://www.lawn.gatech.edu/help/GTvisitor.html">GTvisitor Wireless Network Information</a></li>
                            <li class="gt-default-mini-left"><a href="https://pe.gatech.edu/global-learning-center/">Georgia Tech Global Learning Center</a></li>
                            <li class="gt-default-mini-right"><a href="http://www.gatechhotel.com">Georgia Tech Hotel &amp; Conference Center</a></li>
                            <li class="gt-default-mini-left"><a href="http://www.gatech.bncollege.com">Barnes &amp; Noble at Georgia Tech</a></li>
                            <li class="gt-default-mini-right"><a href="http://www.ferstcenter.gatech.edu">Ferst Center for the Arts</a></li>
                            <li class="gt-default-mini-left"><a href="http://www.ipst.gatech.edu/amp">Robert C. Williams Paper Museum</a></li>
                        </ul>
                    </div>

                </div>
            </section>

            <footer id="footer">
                <div class="row clearfix">
                    <div id="footer-utility-links">
                        <ul class="menu<?php
                        if ($footer_ulinks): print ' custom-links-included';
                        endif;
                        ?>">
                            <li class="first"><a href="http://www.gatech.edu/emergency/">Emergency Information</a></li>
                            <li><a href="http://www.gatech.edu/legal/">Legal &amp; Privacy Information</a></li>
                            <li><a href="http://www.gatech.edu/accessibility/">Accessibility</a></li>
                            <li><a href="http://www.gatech.edu/accountability/">Accountability</a></li>
                            <li class="last"><a href="https://www.gatech.edu/accreditation/">Accreditation</a></li>
                        </ul>
                    </div>
                    <div id="footer-logo">
                        <a href="http://www.gatech.edu/"><img alt="Georgia Tech" src="/sites/all/themes/gt/images/logos/gt-logo-footer-retina.png" ></a>
                        <p>&copy; Georgia Institute of Technology</p>
                    </div>
                </div>
            </footer><!-- /footer -->

        </div><!-- /#page -->

        <?php print render($page['bottom']); ?>

    </body>
</html>