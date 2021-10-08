<?php
/**
 * @package ginkgos
 * @since 0.0.1
 * @Last-Update 0.0.2
 */

if ( ! class_exists( 'GinkGos_Recent_Comments' ) ) :
	class GinkGos_Recent_Comments extends WP_Widget {

		function __construct() {
			parent::__construct( 'Widget_GinkGos_Recent_Comments', __( 'Recent Comments', 'ginkgos' ), array(
				'classname' 	=> 'Widget_GinkGos_Recent_Comments',
				'description' 	=> __( 'Displays recent comments with user avatars.', 'ginkgos' ),
			) );
		}

		function widget( $args, $instance ) {

			// Outputs the content of the widget
			extract( $args ); // Make before_widget, etc available.

			$widget_title = isset( $instance['widget_title'] ) ? apply_filters( 'widget_title', $instance['widget_title'] ) : '';
			$number_of_comments = isset( $instance['number_of_comments'] ) ? $instance['number_of_comments'] : 5;

			echo esc_html($before_widget);

			if ( ! empty( $widget_title ) ) {
				echo esc_html($before_title . $widget_title . $after_title);
			} 
			
			?>

			<ul class="ginkgos-widget-list">

				<?php

				if ( 0 === $number_of_comments ) {
					$number_of_comments = 5;
				}

				global $comment;

				// The Query
				$comments_query = new WP_Comment_Query;
				$comments_local = $comments_query->query( array(
					'orderby'	=> 'date',
					'number'	=> $number_of_comments,
					'status'	=> 'approve',
				) );

				// Comment Loop
				if ( $comments_local ) :
					foreach ( $comments_local as $comment_local ) : 
						?>

						<li class="group">

							<a href="<?php the_permalink( $comment_local->comment_post_ID ); ?>#comment-<?php echo esc_html($comment_local->comment_ID); ?>">

								<div class="post-icon">
									<?php echo get_avatar( get_comment_author_email( $comment_local->comment_ID ), '100' ); ?>
								</div>

								<div class="inner">
									<p class="title"><span><?php comment_author(); ?></span></p>
									<p class="excerpt">"<?php echo wp_kses_post( ginkgos_get_comment_excerpt( $comment_local->comment_ID, 13 ) ); ?>"</p>
								</div>

							</a>

						</li>

						<?php
					endforeach;
				endif;
				?>

			</ul>

			<?php 

			echo esc_html($after_widget);
		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['widget_title'] = isset( $new_instance['widget_title'] ) ? strip_tags( $new_instance['widget_title'] ) : '';

			// Make sure we are getting a number
			$instance['number_of_comments'] = isset( $new_instance['number_of_comments'] ) && is_int( $new_instance['number_of_comments'] ) ? $new_instance['number_of_comments'] : 5;

			// Update and save the widget
			return $instance;

		}

		function form( $instance ) {

			if ( ! isset( $instance['widget_title'] ) ) $instance['widget_title'] = '';
			if ( ! isset( $instance['number_of_comments'] ) ) $instance['number_of_comments'] = 5;

			$widget_title = $instance['widget_title'];
			$number_of_comments = $instance['number_of_comments'];

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php  esc_html_e( 'Title', 'ginkgos' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $widget_title ); ?>" /></label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>"><?php esc_html_e( 'Number of comments to display', 'ginkgos' ); ?>:
				<input id="<?php echo esc_attr( $this->get_field_id( 'number_of_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_comments' ) ); ?>" type="text" class="widefat" value="<?php echo esc_attr( $number_of_comments ); ?>" /></label>
				<small>(<?php esc_html_e( 'Defaults to 5 if empty', 'ginkgos' ); ?>)</small>
			</p>

			<?php
		}

	}
endif;
