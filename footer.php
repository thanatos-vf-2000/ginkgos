		</main><!-- #site-content -->

		<?php if ( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ) : ?>

			<footer class="footer section big-padding bg-white">
				<div class="section-inner group">

					<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
						<div class="widgets"><?php dynamic_sidebar( 'footer-one' ); ?></div>
					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
						<div class="widgets"><?php dynamic_sidebar( 'footer-two' ); ?></div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
						<div class="widgets"><?php dynamic_sidebar( 'footer-three' ); ?></div>
					<?php endif; ?>

				</div><!-- .section-inner -->
			</footer><!-- .footer.section -->

		<?php endif; ?>

		<div class="credits section bg-dark">
			<?php
			if ( has_nav_menu( 'secondary' ) ):
				echo '<div class="footer-menu"><ul>';
				$menu_args = array(
					'container' 		=> '',
					'items_wrap' 		=> '%3$s',
					'theme_location' 	=> 'secondary',
				);

				wp_nav_menu( $menu_args );
				echo '</ul></div>';
			endif;
			?>
			<div class="credits-inner section-inner">

				<p class="powered-by"><?php esc_html_e( 'Powered by', 'ginkgos' ); ?> <a href="https://www.wordpress.org">WordPress</a> <span class="sep">&amp;</span> <span class="theme-by"><?php esc_html_e( 'Theme by', 'ginkgos' ) ?> <a href="https://ginkgos.net">Franck VANHOUCKE</a></span></p>

			</div><!-- .section-inner -->

		</div><!-- .credits.section -->


		<?php 
		if (get_theme_mod( 'back-to-top-enable',ginkgos_option( 'back-to-top-enable' ) )) {

			$icon = get_theme_mod('back-to-top-arrow');
			$icon = ($icon == "") ? ginkgos_option( 'back-to-top-arrow' ) : $icon;
			echo '<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas ' . $icon . '"></i></a>';
		}

		$progressbar =  get_theme_mod('progress-bar-enable');
		$progressbar_bubble =  get_theme_mod('progress-bar-bubble');
		$progressbar_bubble = ($progressbar_bubble) ? '<div class="progressbar__bubble">0%</div>' : '';
		if ( !is_front_page() && $progressbar ) {
			echo '<div id="progressbar" class="progressbar" style="width: 0%;">' . $progressbar_bubble. '</div>';
		}
		
		wp_footer(); 
		?>

	</body>
</html>
