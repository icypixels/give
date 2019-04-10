<?php get_header(); ?>
			

<?php 
    $title = get_post_meta($post->ID, 'icy_page_title', true);           
    $subtitle = get_post_meta($post->ID, 'icy_page_subtitle', true);
    $featured = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );           
?>
<?php if (!empty($featured)) : ?>
<div class="featured-message">
    
    <img src="<?php echo $featured ?>" alt="" />
    <div class="centered">
        <h1><?php _e('Search Results for', 'framework') ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>
        <h3><?php echo $subtitle; ?></h3>
    </div>    

 </div>
<?php endif; ?>
<section id="primary">
<div class="wrapper">
			
		<div class="container background row-fluid main-container">

			<!--BEGIN #main-content -->
			<section class="main-content span9">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .post -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">		                
	    
	                        <!--BEGIN .entry-content -->
	                        <div class="entry-content">
	                        
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
				                    <?php the_content(__('Read more', 'framework')); ?>
				                </div>				                
	                            
	                        <!--END .entry-content -->
	                        </div>     
	                          
					<!--END .post-->  
					</div>

				<?php endwhile; ?>
	                
	            <?php comments_template('', true); ?>

				<?php else : ?>

					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="entry-title"><?php _e('Your search did not match any entries', 'framework') ?></h2>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e('You searched: ', 'framework'); ?>&#8220;<?php the_search_query(); ?>&#8221;</p>
						<p><?php _e('Suggestions:','framework') ?></p>
						<ul>
							<li><?php _e('Make sure all words are spelled correctly.', 'framework') ?></li>
							<li><?php _e('Try different keywords.', 'framework') ?></li>
							<li><?php _e('Try more general keywords.', 'framework') ?></li>
						</ul>
						<?php get_search_form(); ?>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>

				<?php endif; ?>

			<!--END main-content -->
			</section>


<?php get_sidebar(); ?>

	</div>

</div>
</section>
<?php get_footer(); ?>