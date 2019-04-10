<?php $template_directory =  get_template_directory_uri(); ?>
<?php

// Do not delete these lines or the sky will fall over your head
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

	if ( have_comments() ) : // if there are comments ?>
        
    <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>

<div class="comments-container span12">

	    <div class="share-post">
											
											                	
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

		<div class="comments-message">
			<?php if(get_option('icy_comments_message') == '') : ?>
				<?php _e('Write us your thoughts about this post. Be kind & Play nice.', 'framework'); ?>
			<?php else : ?>
				<?php echo get_option('icy_comments_message'); ?>
			<?php endif; ?> 	
		</div>

	<!-- BEGIN .list-of-comments -->	
    <div class="span12 commentaries-border">
        
        <!--BEGIN .list-of-comments OUTPUT -->
		<ol id="comments" class="list-of-comments">
        
        <?php wp_list_comments('type=comment&avatar_size=48&callback=icy_comment'); ?>
        
        <!--END .list-of-comments OUTPUT -->
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		
		<!--START separated pings listing -->
		<h4 id="pings"><?php _e('Trackbacks for this post', 'framework') ?></h4>

		<ol class="pinglist">
        
			<?php wp_list_comments('type=pings&callback=icy_list_pings'); ?>
        
        </ol>
        <!--END separated pings listing -->
        
		
        
        <?php endif; ?>
		
		<!--BEGIN comment navigation -->
		<div class="navigation">
        
			<div class="alignright"><?php next_comments_link(); ?></div>
            <div class="alignleft"><?php previous_comments_link(); ?></div>
        
        <!--END comment navigation -->
		</div>

	<!--END .list-of-comments -->
	</div>

		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Dealing with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are closed now.', 'framework') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>
        <div class="comments-container" style="margin-top: 0; margin-bottom: 40px">
	    	<div class="share-post">
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

			<div class="comments-message">
				<?php if(get_option('icy_comments_message') == '') : ?>
					<?php _e('Write us your thoughts about this post. Be kind & Play nice.', 'framework'); ?>
				<?php else : ?>
					<?php echo get_option('icy_comments_message'); ?>
				<?php endif; ?> 	
			</div>

		</div>
        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'framework') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>
    
    <div id="respond" class="span12" style="margin-left: 0">

	    <h3 class="no-bottom"><?php comment_form_title( __('Leave a reply.', 'framework'), __('Reply to %s', 'framework') ); ?></h3>

		<div class="cancel-comment-reply">       
			<?php cancel_comment_reply_link(); ?>
        </div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>	
        <p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'framework'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>	
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="span12" id="comments-form" style="margin-left: 0">

			<?php if ( is_user_logged_in() ) : ?>		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'framework'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'framework').'">', '</a>') ?></p>		
			<?php else : ?>
		
			<p>
			<input type="text" name="author" value="Name (required)" id="author" value="<?php echo esc_attr($comment_author); ?>" size="20" tabindex="1" onfocus="if (this.value == 'Name (required)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name (required)';}"/>
			</p>
		
			<p>
			<input type="text" name="email" value="Email (required)"  id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="20" tabindex="2" onfocus="if (this.value == 'Email (required)') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email (required)';}"/>
			</p>
		
			<p>
			<input type="text" name="url" id="url" value="Your Website" size="20" tabindex="3"onfocus="if (this.value == 'Your Website') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Website';}"/>
			</p>
		
			<?php endif; ?>
		
			<p>
			<textarea name="comment" id="comment" cols="55" rows="10" tabindex="4" value="Write your comment here" onfocus="if (this.value == 'Write your comment here') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Write your comment here';}"></textarea>
			</p>
		
			<p class="no-bottom">
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'framework') ?>" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>
	<?php endif; // if you delete this the sky will fall on your head ?>

