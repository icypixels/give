<?php
/*
Template Name: Home
*/
?>

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
        <h1><?php echo $title; ?></h1>
        <h3><?php echo $subtitle; ?></h3>
    </div>    

 </div>
<?php endif; ?>

<div class="homepage-full-width-widget">
    <div class="wrapper">     
        <div class="row-fluid">
            <div class="span12">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage - Full Width' ) ) ?>                     
            </div>
        </div>
    </div>
</div>
<section id="primary">
        
        <div class="wrapper">

            <div class="container background row-fluid main-container">

                <!--BEGIN #main-content -->
                <section class="main-content span12">
                            
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                        <!--BEGIN .post -->
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                           

                            <!--BEGIN .entry-content -->
                            <div class="entry-content">
                        
                                <?php the_content(); ?>

                                <div class="homepage-widgets">                                                        

                                    <div class="span3">     
                                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage - 1st Column' ) ) ?>                     
                                    </div>

                                    <div class="span6">     
                                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage - 2nd Column' ) ) ?>                     
                                    </div>

                                    <div class="span3">     
                                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage - 3rd Column' ) ) ?>                     
                                    </div>

                                </div><!--DETECT ME-->
                                
                                <?php comment_form(); ?>                            
                            
                            <!--END .entry-content -->
                            </div>

        				<!--END .post-->  
        				</div>

    				<?php endwhile; ?>

    			<?php else : ?>

    				<!--BEGIN #post-0-->
    				<div id="post-404" <?php post_class(); ?>>
    				
    					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
    				
    					<!--BEGIN .entry-content-->
    					<div class="entry-content">
    						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
    					<!--END .entry-content-->
    					</div>
    				
    				<!--END #post-0-->
    				</div>

    			<?php endif; ?>

            </section>

        </div>

    </div>

</section>

<?php get_footer(); ?>