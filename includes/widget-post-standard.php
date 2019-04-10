<?php 
if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>
    
    <div class="post-media">
    	<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-widget-small'); ?></a>
    </div>
    
<?php } ?>
