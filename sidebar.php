
		<!--BEGIN .sidebar four columns-->
		<aside class="sidebar span3">
			
			<?php 
			if(!is_page()) :
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Sidebar Right') ) : ?>
				
                <?php
				
				endif;
			else:
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Pages Sidebar') ) : ?>
                
                <?php
				endif;
			endif;
			?>
   					
		<!--END .sidebar .four columns-->
		</aside>