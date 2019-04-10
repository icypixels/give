<?php get_header(); ?>      

<section id="primary">
<div class="wrapper">
			
		<div class="container background row-fluid main-container">

		<!--BEGIN main content-->
		<section class="main-content span9">
        		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!--BEGIN post -->
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">	              

				<!--BEGIN .entry-content -->
                <div class="entry-content span12" style="margin-left: 0">

            		<?php 
				        $format = get_post_format();
				        if( false === $format ) { $format = 'standard'; }
				    ?>

	            	<?php get_template_part( 'post', $format ); ?>	                   

                    <h1 class="small-entry-title" style="clear: both">
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
                            <?php the_title(); ?>
                        </a>
                    </h1>		                   		               

	                <div class="the-content">
	                    <?php the_content(); ?>
	                </div>
                            
                    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                    <!--END .entry-content -->
                    </div>                    
         
                <!--END POST CONTENT -->
                </article>                        

			<?php endwhile; ?>
            
            <?php comments_template('', true); ?>
            

		<?php else : ?>

			<!--BEGIN #post-0-->
			<div id="post-0" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
			
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				<!--END .entry-content-->
				</div>
			
			<!--END #post-0-->
			</div>

		<?php endif; ?>
        
        
		<!--END main content-->
		</section>

	<?php get_sidebar(); ?>

	</div>
</div>

</section>

<?php get_footer(); ?>