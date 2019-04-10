<?php
/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function icy_head_css() {

		$shortname =  get_option('icy_shortname'); 
		$output = '';
		
		$custom_css = get_option('icy_custom_css');
        $highlight = get_option( 'icy_highlight_color' );       

        if ($highlight <> '') {
            $output .= "\n  .widget_wp_email_capture_widget_class input[type=\"submit\"], .more-link:hover, button:hover, input[type=\"submit\"]:hover, .icy-donate-btn a, .comments-message, span.reply-to a:hover { background-color: " . $highlight . "; }";
            $output .= "a:hover, .navigation-posts a:hover, .small-entry-title a:hover, .widget a:hover { color: ". $highlight . "; }"; 
            $output .= "blockquote { border-color: ". $highlight . "; }";
        }

		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
        if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
add_action('wp_head', 'icy_head_css');

/*-----------------------------------------------------------------------------------*/
/* - Add Favicon
/*-----------------------------------------------------------------------------------*/

function icy_favicon() {

	$shortname = get_option('icy_shortname');

	if (get_option($shortname . '_custom_favicon') != '') {

	echo '<link rel="shortcut icon" href="'. get_option('icy_custom_favicon') .'"/>'."\n";

	}

	else { ?>

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />

	<?php }
}
add_action('wp_head', 'icy_favicon');

/*-----------------------------------------------------------------------------------*/
/* - Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function icy_analytics(){
	$shortname =  get_option('icy_shortname');
	$output = get_option($shortname . '_google_analytics');

	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";

}
add_action('wp_footer','icy_analytics');


/*-----------------------------------------------------------------------------------*/
/* - Custom Functions for Post Formats */
/*-----------------------------------------------------------------------------------*/

/* Output image */
if ( !function_exists( 'icy_image' ) ) {
    function icy_image($postid, $imagesize) {
        // get the featured image for the post
        $thumbid = 0;
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
    
        // get first 2 attachments for the post
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => 2
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            foreach( $attachments as $attachment ) {
                // if current image is featured image reloop
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div class='image-frame'>";
                echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                echo "</div>";
                // got image, time to exit foreach
                break;
            }
        }
    }
}
if ( !function_exists( 'icy_gallery' ) ) {
    function icy_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                   
                $('.flexslider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    animationLoop: true,
                    slideshow: true,
                    useCSS: true,
                });
            });
        </script>
        <?php         
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }                   
        
        $image_ids_raw = get_post_meta($postid, '_icy_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            echo "<!-- BEGIN #slider -->\n<div id='slider-$postid' class='flexslider'>"; 
            echo '<ul class="slides">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? $caption : $posttitle;
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' /></li>";
                $i++;
            }
            echo '</ul>';
            echo "<!-- END #slider -->\n</div>";
        }
        
    }
}

/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Sidebar Position
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_body_class' ) ) { 
    function icy_body_class($classes) {        
        $layout = get_option('icy_sidebar_position');
        if ($layout == '') {
            $layout = 'sidebar-right';
        }
        $classes[] = $layout;
        return $classes;
    }
    add_filter('body_class','icy_body_class');
}

?>