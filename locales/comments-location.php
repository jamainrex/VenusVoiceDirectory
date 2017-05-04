<?php
wp_reset_postdata();
if(comments_open( ) || have_comments()) : 
 if ( have_comments() && comments_open()) :
		  paginate_comments_links(); ?>
		  <!-- Respond Area -->
			<div class="comments-area">
				 <h5 class="comments-area-title"><?php _ex( 'Comments', 'comment-form','locales'); ?></h5>
				 <ul class="clean-list comments-list">
					  <?php wp_list_comments( array( 'callback' => 'tt_custom_comments' , 'avatar_size'=>'54','style'=>'ul') ); ?>
				 </ul>
			</div>
	 <?php endif;
	 if ( post_password_required() ) : ?>
		  <p><?php esc_attr_e( 'This post is password protected. Enter the password to view any comments ', 'locales' ); ?></p>

		  <?php
		  /* Stop the rest of comments.php from being processed,
			* but don't kill the script entirely -- we still have
			* to fully load the template.
			*/
		  return;
		  endif;
		  $args = array(
				'fields' => apply_filters( 'comment_form_default_fields', array(

					 'author'    => '<div class="input-line">
								<input type="text" name="author" class="form-input check-value" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" aria-required="true" placeholder="'.esc_attr_x('Enter your name','comment-form','locales').'" />
							</div>',

					 'email'     =>  '<div class="input-line">
								<input type="text" name="email" class="form-input check-value" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" aria-required="true" placeholder="'.esc_attr_x('Enter your e-mail address','comment-form','locales').'" />
							</div>',


					 'url'       =>  '<div class="input-line">
								<input type="text" name="url" class="form-input check-value" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" aria-required="false" placeholder="'.esc_attr_x('Enter your Website URL','comment-form','locales').'" />
							</div>'

					 )
				),
				'comment_notes_after' => '',
				'comment_notes_before' => '',
				'class_form'    =>  'comments-form',
				'title_reply_before' => '<h5 class="comments-area-title">',
				'title_reply_after' => '</h5>',
				'title_reply'   => esc_attr_x('Leave a reply','comment-form','locales'),
				'comment_field' => '<div class="input-line">
								<textarea name="comment" aria-required="true" class="form-input check-value" placeholder="'.esc_attr_x('Message','comment-form','locales').'"></textarea>
							</div>',
				'label_submit'  => esc_attr_x('Send','comment-form','locales'),
				'class_submit'  =>  'btn-submit btn btn-default'
		  );
	 comment_form( $args );
endif; ?>