<?php

/* ------------------------------------------------- */
/* 	Populating the Theme Options Panel with options
/* ------------------------------------------------- */

add_action('init','icy_options');

if (!function_exists('icy_options')) {
	
function icy_options() {
	
// define the template path for further use	
$GLOBALS['template_path'] = ICY_DIRECTORY;	
	
// variables
	$themename = wp_get_theme();
	$shortname = "icy";

// populating option in array for use in theme
	global $icy_options;
		$icy_options = get_option('icy_options');

// access the WordPress Pages via an Array
	$icy_pages = array();
	
	$icy_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	
	foreach ($icy_pages_obj as $icy_page) {
    	$icy_pages[$icy_page->ID] = $icy_page->post_name; }
	
	$icy_pages_tmp = array_unshift($icy_pages, "Select a page:");  
	     
// access the WordPress Categories via an Array
	$icy_categories = array();  
	
	$icy_categories_obj = get_categories('hide_empty=0');
	
	foreach ($icy_categories_obj as $icy_cat) {
    	$icy_categories[$icy_cat->cat_ID] = $icy_cat->cat_name;}
	
	$categories_tmp = array_unshift($icy_categories, "Select a category:");
// testing 
	$options_select = array("one","two","three","four","five"); 
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

// image links to options
	$options_image_link_to = array("image" => "Image","post" => "Post"); 

// image alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 


//
	$uploads_arr = wp_upload_dir();
	$all_uploads = get_option('icy_uploads');
	$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");	
	$all_uploads_path = $uploads_arr['path'];
	$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
	$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");



$options = array();


// General Settings

$options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");

$options[] = array( "name" => "",
					"message" => __('Welcome to the Theme Options panel! Thanks for purchasing a <a href="http://www.icypixels.com/">Icy Pixels</a> theme. Before asking any questions, make sure you read the documentation first. If you still have any questions, fill in a ticket at <a href="http://icypixels.ticksy.com/">IcyPixels.com Support</a>. ', 'framework'),
					"type" => "intro");   
					
$options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px x 16px .png/.gif image that will represent your site\'s favicon.','framework'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");
				
$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo to your theme, or specify the image address of your online logo. (http://example.com/logo.png). Standard logo size: 170x60 px . Retina logo size: 340x120 px','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");					

$options[] = array( "name" => __('Enable Donate Button','framework'),
					"desc" => __('Tick to enable the Donate Button.','framework'),
					"id" => $shortname."_enable_donate",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => __('Donate Link','framework'),
					"desc" => __('Type in the link the user will be redirected to when clicking on the donate button.','framework'),
					"id" => $shortname."_donate_link",
					"std" => "#",
					"type" => "text");

$options[] = array( "name" => __('Blog Category','framework'),
					"desc" => __('Choose the category that contains all your blog posts.','framework'),
					"id" => $shortname."_blog_category",
					"std" => "",
					"type" => "select-cat");

$options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste in your Analytics (Google or other) tracking code in here. It will be inserted just before the closing body tag of your theme.','framework'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    				

$options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" => $shortname."_feedburner",
					"std" => "",
					"type" => "text");

// Styling Options

$options[] = array( "name" => __('Styling Options','framework'),
					"type" => "heading");

$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

// Posts Settings

$options[] = array( "name" => __('Comments Text','framework'),
					"type" => "heading");

$options[] = array( "name" => __('Comments Message','framework'),
					"desc" => __('Enter a message to be displayed next to the comments section','framework'),
					"id" => $shortname."_comments_message",
					"std" => "Write us your thoughts about this post. Be kind & Play nice.",
					"type" => "text");
					

update_option('icy_themename',$themename);   

update_option('icy_shortname',$shortname);

update_option('icy_template',$options); 					  

}
}



add_action ('admin_menu', 'icy_admin');
function icy_admin() {
    // add the Customize link to the admin menu
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}

add_action('customize_register', 'icy_customize');
function icy_customize($wp_customize) {
 
    $wp_customize->add_setting( 'some_setting', array(
        'default'        => 'default_value',
    ) );
 
    $wp_customize->add_control( 'some_setting', array(
        'label'   => 'Text Setting',
        'section' => 'icy_demo_settings',
        'type'    => 'text',
    ) );
 
    $wp_customize->add_setting( 'icy_highlight_color', array(
        'default'        => '#f3b137',
        'type'           => 'option',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icy_highlight_color', array(
        'label'   => 'Highlight color',
        'section' => 'colors',
        'settings'   => 'icy_highlight_color',
        'transport'         => 'postMessage',
    ) ) );


function icy_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
    wp.customize('icy_highlight_color',function( value ) {
        value.bind(function(to) {
            $('.eventsListWidget ul li .when, .icy-blog-widget .entry-meta, .icy-blog-widget .entry-meta-standard, ul.posts-list .entry-meta, .more-link:hover, .widget_woothemes_testimonials .testimonials .quote cite, button:hover, input[type="submit"]:hover, .icy-donate-btn a, .comments-message, span.reply-to a:hover').css('background', to ? '#' + to : '' );
            $('a:hover, .navigation-posts a:hover, .small-entry-title a:hover, .widget a:hover').css('color', to ? '#' + to : '' );
            $('blockquote').css('border-color', to ? '#' + to : '' );
        });
    });
    } )( jQuery )
    </script>
    <?php 
} 
 
if ( $wp_customize->is_preview() && ! is_admin() )
    add_action( 'wp_footer', 'icy_customize_preview', 21);
}



?>
