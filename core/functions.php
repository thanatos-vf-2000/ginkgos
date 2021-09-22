<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

 /* ---------------------------------------------------------------------------------------------
   GET COMMENT EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'ginkgos_get_comment_excerpt' ) ) :
	function ginkgos_get_comment_excerpt( $comment_id = 0, $num_words = 20 ) {

		$comment = get_comment( $comment_id );
		$comment_text = strip_tags( $comment->comment_content );
		$blah = explode( ' ', $comment_text );
		if ( count( $blah ) > $num_words ) {
			$k = $num_words;
			$use_dotdotdot = 1;
		} else {
			$k = count( $blah );
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ( $i = 0; $i < $k; $i++ ) {
			$excerpt .= $blah[ $i ] . ' ';
		}
		$excerpt .= ( $use_dotdotdot ) ? '...' : '';

		return apply_filters( 'get_comment_excerpt', $excerpt );

	}
endif;


/* ---------------------------------------------------------------------------------------------
   OUTPUT POST META
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'ginkgos_post_meta' ) ) :
	function ginkgos_post_meta() {

		?>
		
		<div class="post-meta">

			<p class="post-author"><span><?php _e( 'By', 'ginkgos' ); ?> </span><?php the_author_posts_link(); ?></p>

			<p class="post-date"><span><?php _e( 'On', 'ginkgos' ); ?> </span><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></p>

			<?php if ( has_category() ) : ?>
				<p class="post-categories"><span><?php _e( 'In', 'ginkgos' ); ?> </span><?php the_category( ', ' ); ?></p>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'ginkgos' ), '<p>', '</p>' ); ?>

		</div><!-- .post-meta -->

		<?php

	}
endif;


/* ---------------------------------------------------------------------------------------------
   COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'ginkgos_comment' ) ) :
	function ginkgos_comment( $comment, $args, $depth ) {

		if ( in_array( $comment->comment_type, array( 'pingback', 'trackback' ) ) ) : ?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<?php __( 'Pingback:', 'ginkgos' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'ginkgos' ), '<span class="edit-link">', '</span>' ); ?>
			</li>

			<?php
		else :
			global $post; ?>

			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

				<div id="comment-<?php comment_ID(); ?>" class="comment">

					<?php

					echo get_avatar( $comment, 160 );

					if ( $comment->user_id === $post->post_author ) : ?>

						<a class="comment-author-icon" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<div class="genericon genericon-user"></div>
						</a>

					<?php endif; ?>

					<div class="comment-inner">

						<div class="comment-header">
							<h4><?php echo get_comment_author_link(); ?></h4>
						</div><!-- .comment-header -->

						<div class="comment-content post-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->

						<div class="comment-meta">

							<div>
								<div class="genericon genericon-day"></div><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							</div>

							<?php edit_comment_link( __( 'Edit', 'ginkgos' ), '<div><div class="genericon genericon-edit"></div>', '</div>' ); ?>

							<?php if ( 0 == $comment->comment_approved ) : ?>

								<div class="comment-awaiting-moderation">
									<div class="genericon genericon-show"></div>
									<?php _e( 'Your comment is awaiting moderation.', 'ginkgos' ); ?>
								</div>

								<?php
							else :

								comment_reply_link( array(
									'reply_text' 	=> __( 'Reply', 'ginkgos' ),
									'depth'			=> $depth,
									'max_depth' 	=> $args['max_depth'],
									'before'		=> '<div><div class="genericon genericon-reply"></div>',
									'after'			=> '</div>',
								) );

							endif; ?>

						</div><!-- .comment-meta -->

					</div><!-- .comment-inner -->

				</div><!-- .comment-## -->

			<?php
		endif;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   Read Option FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'ginkgos_option' ) ) :
	function ginkgos_option($name) {
		return GINKGOS\Core\BaseController::get_option($name);
	}
endif;