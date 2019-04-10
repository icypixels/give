<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Icy Pixels | Powered by WordPress -->

<!-- BEGIN head -->
<head>

	<!-- Basic Page Needs -->
    <title><?php
    if (is_home()) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif(is_page_template('template-home.php')) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_single() || is_page()) { single_post_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_search()) { _e('Search Results', 'framework'); echo " ".wp_specialchars($s); }
    elseif (is_category() || is_tag()) { single_cat_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    else { echo trim(wp_title(' ',false)); }
    ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
    
    <!-- RSS & Pingbacks -->
   	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php 
    $feed = get_option(' icy_feedburner ');
    if ($feed != '')
    {
        echo get_option(' icy_feedburner ');
    }
    else
    {
        bloginfo('rss2_url');
    } ?>" />
   	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Theme Hook -->
    <?php wp_head(); ?> 
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
  
</head>
<!-- END head section -->

<body <?php body_class('body-content'); ?>>
<!-- START body -->

<div id="hello-bar">
    <div class="wrapper">
        <div class="row-fluid">

            <div class="span9 top-message">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Header Top - Main' ) ) ?>
            </div>

            <div class="span3 social-icons">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Header Top - Social' ) ) ?>
            </div>

        </div>
    </div>
</div>

<div id="headerTop">

    <div class="wrapper">

        <div class="row-fluid">

            <!-- Start Logo section -->
            <header class="header container clearfix">

                <!-- START #logo -->
                <div class="logo span5">

                <?php 
                        /*
                        If the "plain text logo" is set in theme options -> using text
                        if a logo url has been set in theme options -> using image
                        if none of the above then -> default logo.png */
                        
                        if (get_option('icy_logo')) { ?>
                        <span class="logo-image"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('icy_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a></span>
                        <?php } else { ?>

                        <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>

                        <?php } ?>
                
                <!-- END #logo -->
                </div>

                <?php
                    $enabled = get_option('icy_enable_donate');
                    $link = get_option('icy_donate_link'); 
                ?>

                <?php if($enabled == 'true') { ?>
                    <div class="icy-donate-btn">
                        <a href="<?php if (!empty($link)) echo $link; ?>">Donate</a>                
                    </div>
                <?php } ?>

                <div class="icy-header-search">
                    <!-- #searchbar -->
                    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="clearfix" >
                        <div>
                            <input type="text" name="s" id="s"/><i class="icon-search"></i>
                        </div>
                    </form>
                    <!-- /#searchbar-->    
                </div>

            </header>
            <!-- END header -->
        </div>

    </div>

</div>

<div id="topNav">
    <div class="wrapper">

    <!-- START nav -->
    <nav class="row-fluid">

        <div class="container">
            
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'main-menu', 
                    'container' => '', 
                    'before' => '',
                ) ); 
            ?>

        </div>

    </nav>
    <!-- END nav -->

    </div>
</div>

