<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?>>
    <head profile="<?php print $grddl_profile; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php print $head; ?>
        <title><?php print $head_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php print $styles; ?>
        <?php print $scripts; ?>
        <?php
        // Add relevant version 2.5 stlying
        if ($gt_styling_version == 'gt-theme-style-2-5') :
          ?>

        <?php endif; ?>
        <!--[if lte IE 8]>
        <style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/css/ie.css";</style>
        <![endif]-->
    </head>
    <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
        <!--[if IE 7]>
        <div class="ie-smells-wrapper ie7"><![endif]-->
        <!--[if IE 8]>
        <div class="ie-smells-wrapper ie8"><![endif]-->
        <!--[if IE 9]>
        <div class="ie-smells-wrapper ie9"><![endif]-->
        <p id="skip-links" class="element-invisible">
            <a href="#main" class="element-invisible element-focusable">Skip to content</a>
        </p>
        <?php print $page_top; ?>
        <?php print $page; ?>
        <?php print $page_bottom; ?>
        <!--[if IE 7]></div><![endif]-->
        <!--[if IE 8]></div><![endif]-->
        <!--[if IE 9]></div><![endif]-->

    </body>
</html>
