<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Blog Widget
	Description: A widget that allows the display of blog posts.

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'icy_blog_widgets' );


// Register widget.
function icy_blog_widgets() {
	register_widget( 'icy_Blog_Widget' );
}

// Widget class.
class icy_blog_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function icy_Blog_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'icy_blog_widget', 'description' => __('A widget that displays your latest posts with a short excerpt.', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'icy_blog_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'icy_blog_widget', __('Custom Recent Posts Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
			<div class="icy-blog-widget row-fluid">
                
					<?php 
                    $query = new WP_Query();
                    $query->query( array(
                        'posts_per_page' => $number,                        
                        ));
                    ?>

                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

					<article <?php post_class(); ?>>
                    	<?php 
					        $format = get_post_format();
					        if( false === $format ) { $format = 'standard'; }
					    ?>
					    

						<?php if($format != 'standard') { ?>    
		                    
							    <?php get_template_part( 'includes/widget-post', $format ); ?>	                   

			                    <h1 class="small-entry-title" style="clear: both">
			                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
			                            <?php the_title(); ?>
			                        </a>
			                    </h1>		                   		               

				                <div class="the-content">
				                    <?php the_excerpt(); ?>
				                </div>

    		

			            <?php } else { ?>

			            	<div class="entry-meta-standard">			                	
			                	<div class="share-options">
				                	<?php if( function_exists('zilla_likes') ) { ?>			                	
				                		<?php zilla_likes(); ?>			                	
				                	<?php } ?> 			                	
				                	/ <?php comments_popup_link(__('<span class="icon-comment-alt"></span> 0', 'framework'), __('<span class="icon-comment"></span> 1', 'framework'), __('<span class="icon-comments"></span> %', 'framework')); ?> 
					                	/ <a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>"  target="blank"><i class="icon-thumbs-up"></i> Like</a>
					                	/ <a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank"><i class="icon-twitter"></i> Tweet</a>														                

				                </div>

			                	<div class="date-wrapper">
			                		<?php the_time( get_option('date_format') ); ?>
			                	</div>
			                </div>

		                    <h1 class="small-entry-title" style="clear: both">
		                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
		                            <?php the_title(); ?>
		                        </a>
		                    </h1>		                   		               

			                <div class="the-content">
			                    <?php the_excerpt(); ?>
			                </div>



			            <?php } ?>
			            
					</article>

	                
	                <?php endwhile; endif; ?>
                    
                    <?php wp_reset_query(); ?>
                
            </div><!--blog_widget-->
		
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );	

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Latest Posts',		
		'number' => 3
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to show:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

	
	<?php
	}
}
?>