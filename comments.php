<?php

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>

	<div class="comments-container">

		<div class="comments-inner">

			<a name="comments"></a>

			<div class="comments-title-container group">

				<h2 class="comments-title">

					<?php
					$comment_count = count( $wp_query->comments_by_type['comment'] );
					/* Translators: %s = number of comments */
					printf( _nx( '%s Comment', '%s Comments', $comment_count, 'Translators: %s = number of comments', 'ginkgos' ), $comment_count ); ?>

				</h2>

				<?php if ( comments_open() ) : ?>
					<p class="comments-title-link"><a href="#respond"><?php esc_html_e( 'Add Comment', 'ginkgos' ); ?> &rarr;</a></p>
				<?php endif; ?>

			</div><!-- .comments-title-container -->

			<div class="comments">

				<ol class="commentlist">
					<?php wp_list_comments( array(
						'type' 		=> 'comment',
						'callback' 	=> 'ginkgos_comment',
					) ); ?>
				</ol>

				<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>

					<div class="pingbacks">

						<h3 class="pingbacks-title">

							<?php
							$pingback_count = count( $wp_query->comments_by_type['pings'] );
							/* Translators: %s = number of pingbacks */
							printf( _nx( '%s Pingback', '%s Pingbacks', $pingback_count, 'Translators: %s = number of pingbacks', 'ginkgos' ), $pingback_count ); ?>

						</h3>

						<ol class="pingbacklist">
							<?php wp_list_comments( array(
								'type' 		=> 'pings',
								'callback' 	=> 'ginkgos_comment',
							) ); ?>
						</ol>

					</div><!-- .pingbacks -->

				<?php endif; ?>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<div class="comments-nav group" role="navigation">
						<div class="fleft"><?php previous_comments_link( __( 'Previous', 'ginkgos' ) ); ?></div>
						<div class="fright"><?php next_comments_link( __( 'Next', 'ginkgos' ) ); ?></div>
					</div><!-- .comment-nav-below -->
				<?php endif; ?>

			</div><!-- .comments -->

		</div><!-- .comments-inner -->

	</div><!-- .comments-container -->

	<?php 
endif;

if ( comments_open() ) {
	echo '<div class="respond-container">';
	comment_form();
	echo '</div><!-- .respond-container -->';
}

?>
