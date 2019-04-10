<?php get_header(); ?>

<section id="primary">

	<div class="wrapper">
		
		<div class="container background row-fluid main-container">

			<!--BEGIN #main-content -->
			<section class="main-content span9">

				<?php

			/* Fetching the Current Author Data */ 
				if(get_query_var('author_name')) :
					$curauth = get_userdatabylogin(get_query_var('author_name'));
				else :
					$curauth = get_userdata(get_query_var('author'));
				endif;

			?>

				<h3 class="page-title"><span class="the-page-title"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
							<?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?>
				 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
							<?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?>
				 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							<?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?>
				 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							<?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?>
				 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							<?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?>
					  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							<?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?>
				 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<?php _e('Blog Archives', 'framework') ?>
				 	  	<?php } ?></span>							
				</h3>


        	<ul class="posts-list">	    	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<!--BEGIN post -->
				<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<!--BEGIN .entry-content -->
		            <div class="entry-content span12">

		            	<div class="row-fluid">

	                	<div class="span12">
							
							<div class="entry-meta">			                	
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
	
			<?php if ( is_category() ) { 
			// If this is a category archive
				printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'framework'), single_cat_title('',false));
			} elseif ( is_tag() ) { 
			// If this is a tag archive
			    printf(__('<h2>Sorry, but there aren\'t any posts tagged %s yet.</h2>', 'framework'), single_tag_title('',false));
			} elseif ( is_date() ) { 
			// If this is a date archive
				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'framework'));
			} elseif ( is_author() ) { 
			// If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'framework'), $userdata->display_name);
			} else {
				echo(__('<h2>No posts found.</h2>', 'framework'));
			}
			endif; ?>	

			<!--END main-content -->
			</section>


<?php get_sidebar(); ?>

	</div>
</div>

</section>

<?php get_footer(); ?>