<?php
/**
 * @file
 * GT theme's implementation to display a single Drupal page.
 *
 * See README for variables explanation.
 *
 */
?>

<header id="gt-header" class="" role="banner">
    <div class="navbar-expand-md navbar-light">

        <!-- Top Header -->
        <div id="top-header" class="top-background-wrapper">
            <div class="container">
                <div class="row stripes justify-content-between">
                    <div class="col-5 col-sm-4 col-md-3 p-0 d-flex flex-row top-angle-wrapper">
                    	<div class="top-background"></div>
						<div class="top-background-angle"></div>
                    </div>
                    <div class="col p-0 d-flex flex-row ctn-background">
	                    <div class="ctn-angle d-none d-lg-block"></div>
                        <!--  CTN Logo -->
                        <div class="ctn d-none d-lg-block">
                            <img src="/sites/all/themes/gt/images/creating_the_next_gold.svg"
                                 style="max-height:1rem" alt="Creating the Next"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="middle-header" class="middle-background-wrapper">
            <div class="container">
                <div class="row middle-background">

                    <!--  GT Logo -->
                    <div class="col-5 col-sm-4 col-md-3 p-0 d-flex flex-row gt-logo-wrapper">
	                    <div class="gt-logo">
	                        <a href="https://www.gatech.edu" title="Georgia Institute of Technology">
	                            <img src="/sites/all/themes/gt/images/gt-logo.svg"
	                                 alt="Georgia Institute of Technology"/>
	                        </a>
	                    </div>
                        <div class="gt-logo-angle"></div>
                    </div>

                    <!--  GT Hambuger -->
                    <div class="col-2 order-md-1 ml-auto">
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#Navbar" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                            <span class="icon-text"></span>
                            <span class="sr-only">Toggle navigation</span>
                        </button>
                    </div>

                    <!--  GT Site Name/Site Title -->
                    <div class="col-12 col-md-9 p-0 d-sm-block d-md-flex align-items-center middle-header">
                        <div class="site-title-multiple">
                            <?php if ($site_title != '') : ?>
                                <h2 class="site-name <?php print $site_title_class; ?>" rel="home">
                                    <a href="<?php print $front_page; ?>"><?php print $site_title; ?></a>
                                </h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Bottom Header -->

        <div id="bottom-header" class="container-fluid pt-2">
            <nav class="container navbar navbar-collapse collapse " id="Navbar">
                <div class="row col">
                    <!--  Page Navigation -->
                    <?php if (!empty($primary_main_menu)): ?>
                    <div id="page-navigation" class="main-nav mr-auto" aria-label="main navigation">
                        <?php if ($main_menu) : ?>
                             <nav role="navigation">
                                    <?php print $primary_main_menu; ?>
                                    <?php
                                    if ($is_admin) : print $primary_main_menu_manage;
                                    endif;
                                    ?>
                                </nav>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!--  Utility Navigation -->
                    <?php if (!empty($action_items)): ?>
                    <div id="utility-navigation" class="force-w-100">
                        <?php if ($action_items): ?>
                            <?php print theme('links', array('links' => $action_items, 'attributes' => array('id' => 'action-items'))); ?>
                            <?php
                            if ($is_admin) : print $action_items_manage;
                            endif;
                            ?>
                        <?php else : ?>
                            <?php
                            if ($is_admin) : print $action_items_add;
                            endif;
                            ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!--  Search -->
                    <?php if (!empty($search_page)): ?>
                        <div id="search-container" class="force-w-100">
                             <?php if (module_exists('search')) : ?>
                                <a href="<?php print $base_path; ?>search" id="site-search-container-switch"
                                   class="element-focusable">Search</a>
                                <div id="site-search-container" class="element-invisible">
                                    <?php print $search_page; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </nav>

        </div>

    </div>

</header>
<div id="page">

    <section role="main" id="main"<?php

    if (isset($spotlight)) : print ' class="with-spotlight"';
    endif;
    ?>>
        <?php $spotlight = render($page['spotlight']); ?>

        <?php if ($spotlight) : ?>
            <section id="header-spotlight">
                <?php print $spotlight; ?>
            </section>
        <?php endif; ?>

        <div class="row clearfix">

            <div id="breadcrumb gt-breadcrumbs-title" class="container <?php print $breadcrumb_remove; ?> hide-for-mobile" role="complementary">
                <div class="breadcrumb-links">

                    <nav class="breadcrumb ">
                        <ul><?php print $breadcrumb; ?></ul>
                    </nav>

                </div>
            </div>

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
                <div id="page-title" class="col col-12">
                    <h1 class="title"><?php print $title; ?></h1>
                </div>
            <?php endif; ?>
            <?php print render($title_suffix); ?>

            <?php
            // Check for content lead/close and left_nav
            $content_lead = render($page['content_lead']);
            $content_close = render($page['content_close']);
            ?>

            <?php if ($content_lead) : ?>
                <div id="content-lead">
                    <?php print $content_lead; ?>
                </div>
            <?php endif; ?>

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
                <?php print render($page['main_top']); ?>
                <?php print render($page['content']); ?>
                <?php print render($page['main_bottom']); ?>
                <?php print $feed_icons; ?>
            </div><!-- /#content -->

            <?php
            // Render the sidebars to see if there's anything in them.
            $left_nav = render($page['left_nav']);
            $sidebar_left = render($page['left']);
            $sidebar_right = render($page['right']);
            ?>

            <?php if ($left_nav || $sidebar_left || $sidebar_right): ?>


                    <?php if ($left_nav || $sidebar_left): ?>
                        <aside id="sidebar-left" class="<?php print $sidebar_left_class; ?>">
                            <?php if ($left_nav) : ?>
                                <nav id="left-nav" role="navigation" aria-label="Local">
                                    <?php print $left_nav; ?>
                                </nav>
                            <?php endif; ?>
                            <?php print $sidebar_left; ?>
                        </aside>
                    <?php endif; ?>

                    <?php if ($sidebar_right): ?>
                        <aside id="sidebar-right" class="<?php print $sidebar_right_class; ?>">
                            <?php print $sidebar_right; ?>
                        </aside>
                    <?php endif; ?>

            <?php endif; ?>

            <?php if ($content_close) : ?>
                <div id="content-close">
                    <?php print $content_close; ?>
                </div>
            <?php endif; ?>

        </div>
    </section><!-- /#main -->

    <!-- Social Media Icons -->
    <div id="social-media-wrapper" class="container-fluid">

    <div class="row social-media-inner clearfix" role="navigation" aria-label="Social Media">


        <?php if ($social_media_links): ?>
            <?php print theme('links', array('links' => $social_media_links, 'attributes' => array('id' => 'social-media-links'))); ?>
            <?php
            if ($is_admin) : print $social_media_links_manage;
            endif;
            ?>
        <?php else : ?>
            <?php
            if ($is_admin) : print $social_media_links_add;
            endif;
            ?>
        <?php endif; ?>

    </div>

    </div>

    <div id="contentinfo" aria-label="Footers">

       <?php print $superfooter_content; ?>



        <!-- #superfooter/ -->

        <!-- /#superfooter -->

        <!-- #footer/ -->

        <!-- Top Footer Gradient Bar -->
        <div class="container-fluid footer-top-bar">
        </div>

        <div id="gt-footer" class="container-fluid footer-bottom-bar">
            <div class="container pt-3">

                <div class="row">
                    <div class="col-sm-12 col-sm-6 col-md-4 col-lg-3 ctn-footer">
                        <img class="float-left" src="/sites/all/themes/gt/images/creating_the_next_black.svg"
                             alt="Creating the Next">
                        <div class="clearfix"></div>

                        <div id="address_text" class="pt-1">
                            <p><strong>Georgia Institute of Technology</strong><br/>
                                North Avenue, Atlanta, GA 30332<br/>
                                404.894.2000</p>
                        </div>
                    </div>




                    <div class="col-sm-12 col-md-4 col-lg-3 pt-1">
                        <ul>
                            <li><a href="http://www.gatech.edu/emergency/">Emergency Information</a></li>
                            <li><a href="http://www.gatech.edu/legal/">Legal &amp; Privacy Information</a></li>
                            <li><a href="https://gbi.georgia.gov/documents/human-trafficking-notice">Human
                                    Trafficking Notice</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-3 pt-1">
                        <ul>
                            <li><a href="http://www.gatech.edu/accessibility/">Accessibility</a></li>
                            <li><a href="http://www.gatech.edu/accountability/">Accountability</a></li>
                            <li><a href="https://www.gatech.edu/accreditation/">Accreditation</a></li>
                            <li><a href="http://www.careers.gatech.edu">Employment</a></li>
                        </ul>
                    </div>

                    <div id="gt-logo-footer" class="col-sm-12 col-sm-6 col-md-12 col-lg-3 p-0">
                        <div id="copyright">
                            <img src="/sites/all/themes/gt/images/gt-logo.svg"
                                 alt="Georgia Institute of Technology"/>
                            <p class="p-1 float-right">© Georgia Institute of
                                Technology</p>
                            <div class="clearfix"></div>
                            <div class="<?php print $login_remove; ?> float-right pb-2">
                                <a href="/cas">Login</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /#footer -->

    </div>
</div><!-- /#page -->

