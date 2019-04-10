<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); global $more; ?>

<?php 
    $title = get_post_meta($post->ID, 'icy_page_title', true);           
    $subtitle = get_post_meta($post->ID, 'icy_page_subtitle', true);
    $featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );           
?>
<?php if (!empty($featured)) : ?>
<div class="featured-message">
    
    <img src="<?php echo $featured ?>" alt="" />
    <div class="centered">
        <h1><?php echo $title; ?></h1>
        <h3><?php echo $subtitle; ?></h3>
    </div>    

 </div>
<?php endif; ?>
<section id="primary" class="primary-blog">
	<div class="wrapper template-blog">

		<div class="container background row-fluid main-container">

			<!--BEGIN main content-->
			<section class="main-content span9">

				<div class="widget-title" style="margin-top: 0"><?php _e('Latest Posts', 'framework'); ?></div>

			<?php $blogcat = get_option('icy_blog_category'); ?>
			<?php query_posts( array( 'cat' => $blogcat, 'paged' => get_query_var('paged') ) ); ?>

			<ul class="posts-list">	    	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<!--BEGIN post -->
				<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<!--BEGIN .entry-content -->
		            <div class="entry-content span12">           	            		            		                		          

		                <div class="row-fluid">

		                	<div class="span12">

		                		<?php 
							        $format = get_post_format();
							        if( false === $format ) { $format = 'standard'; }
							    ?>

							    <?php get_template_part( 'post', $format ); ?>		

							    <?php if( is_singular() ) { ?>
			                    
			                    <h1 class="small-entry-title"><?php the_title(); ?></h1>
			                    
			                <?php } else { ?>
			                    
			                    <h1 class="small-entry-title">
			                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
			                            <?php the_title(); ?>
			                        </a>
			                    </h1>
			                    
			                <?php } ?>                	               

				                <div class="the-content">
				                	<?php global $more; $more = 0; ?>
				                    <?php the_content(__('Read more', 'framework')); ?>
				                </div>

				                <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		                	</div>	                	

		                </div>	                				   

		            <!--END .entry-content -->
		            </div>
				
				<!--END post-->  
				</li>

				<?php endwhile; ?>

			</ul>

			<!--BEGIN .navigation-->
			<div class="navigation-posts">
		    
				<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
		        
			<!--END .navigation-->
			</div>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class(); ?>>
				
					<h1 class="entry-title">
						<?php _e('Error 404 - Not Found', 'framework') ?>
					</h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
					
						<p><?php _e("Sorry, but your search lead to no results.", "framework") ?></p>
					
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>

			<?php wp_reset_query(); ?>

			<!-- END main content -->
			</section>

			<?php get_sidebar('right'); ?>

		</div>

	</div>

</section>

<?php get_footer(); ?>