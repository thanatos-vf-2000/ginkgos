<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">

		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php 
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open(); 
		}
		?>

		<a class="skip-link button" href="#site-content"><?php esc_html_e( 'Skip to the content', 'ginkgos' ); ?></a>

		<header class="header-wrapper">

			<div class="header section bg-white small-padding">
				<div class="section-inner group">

					<?php 

					$custom_logo_id 	= get_theme_mod( 'custom_logo' );
					$legacy_logo_url 	= get_theme_mod( 'ginkgos_logo' );
					$blog_title_elem 	= ( ( is_front_page() || is_home() ) && ! is_page() ) ? 'h1' : 'div';
					$blog_title_class 	= $custom_logo_id ? 'blog-logo' : 'blog-title';

					$blog_title_local 	= get_bloginfo( 'title' );
					$blog_description 	= get_bloginfo( 'description' );

					if ( $custom_logo_id  || $legacy_logo_url ) : 

						$custom_logo_url = $legacy_logo_url ? $legacy_logo_url : wp_get_attachment_image_url( $custom_logo_id, 'full' );
					
						?>

						<<?php echo esc_html($blog_title_elem); ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
							<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( $custom_logo_url ); ?>">
								<span class="screen-reader-text"><?php echo esc_html($blog_title_local); ?></span>
							</a>
						</<?php echo esc_html($blog_title_elem); ?>>
			
					<?php elseif ( $blog_description || $blog_title_local ) : ?>

						<<?php echo esc_html($blog_title_elem); ?> class="<?php echo esc_attr( $blog_title_class ); ?>">
							<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo esc_html($blog_title_local); ?></a>
						</<?php echo esc_html($blog_title_elem); ?>>
					
						<?php if ( $blog_description ) : ?>
							<h4 class="blog-tagline"><?php echo esc_html($blog_description); ?></h4>
						<?php endif; ?>
					
					<?php endif; ?>

				</div><!-- .section-inner -->

			</div><!-- .header -->

			<div class="toggles group">

				<button type="button" class="nav-toggle toggle">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle the mobile menu', 'ginkgos' ); ?></span>
				</button>

				<button type="button" class="search-toggle toggle">
					<div class="genericon genericon-search"></div>
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle the search field', 'ginkgos' ); ?></span>
				</button>

			</div><!-- .toggles -->

		</header><!-- .header-wrapper -->

		<div class="navigation bg-white no-padding">
			<div class="section-inner group">

				<ul class="mobile-menu">

					<?php if ( has_nav_menu( 'primary' ) ) {

						$menu_args = array(
							'container' 		=> '',
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'primary',
						);

						wp_nav_menu( $menu_args );

					} else {

						$list_pages_args = array(
							'container' => '',
							'title_li' 	=> '',
						);

						wp_list_pages( $list_pages_args );

					} ?>

				</ul>

				<div class="mobile-search">
					<?php get_search_form(); ?>
				</div><!-- .mobile-search -->

				<ul class="main-menu">

					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( $menu_args );
					} else {
						wp_list_pages( $list_pages_args );
					}
					?>

				</ul><!-- .main-menu -->

			</div><!-- .section-inner -->
			<?php
			if ( function_exists( 'pll_the_languages' ) && in_array('polylang/polylang.php', apply_filters('active_plugins', get_option('active_plugins')))) {
				$polylang_dropdown = (get_theme_mod( 'polylang-dropdown',ginkgos_option('polylang-dropdown'))) ? 1 : 0;
				$polylang_show_names = (get_theme_mod( 'polylang-show-names',ginkgos_option('polylang-show-names'))) ? 1 : 0;
				$polylang_show_names_slug = (get_theme_mod( 'polylang-show-names-slug',ginkgos_option('polylang-show-names-slug'))) ? 'slug' : 'name';
				$polylang_show_flags = (get_theme_mod( 'polylang-show-flags',ginkgos_option('polylang-show-flags'))) ? 1 : 0;
				$polylang_hide_if_empty = (get_theme_mod( 'polylang-hide-if-empty',ginkgos_option('polylang-hide-if-empty'))) ? 1 : 0;
				$polylang_hide_if_no_translation = (get_theme_mod( 'polylang-hide-if-no-translation',ginkgos_option('polylang-hide-if-no-translation'))) ? 1 : 0;
				$polylang_hide_current = (get_theme_mod( 'polylang-hide-current',ginkgos_option('polylang-hide-current'))) ? 1 : 0;
				echo '<div class="language-switcher"><ul>';
				pll_the_languages(array(
					'dropdown'      => $polylang_dropdown,
					'show_names'    => $polylang_show_names,
					'display_names_as' => $polylang_show_names_slug,
					'show_flags'    => $polylang_show_flags,
					'hide_if_empty' => $polylang_hide_if_empty,
					'hide_if_no_translation'    => $polylang_hide_if_no_translation,
					'hide_current'  => $polylang_hide_current,
					//'echo'          => 0,
				));
				echo '</ul></div>';
			}
			?>
		</div><!-- .navigation -->

		<?php if ( is_singular() && has_post_thumbnail() && ! post_password_required() ) :
			$thumb = get_the_post_thumbnail_url( $post->ID, 'post-image-cover' );
			?>

			<figure class="header-image bg-image" style="background-image: url( <?php echo esc_url( $thumb ); ?> );">
				<?php the_post_thumbnail( 'post-image-cover' ); ?>
			</figure>

		<?php else :

			if ( get_header_image() ) {
				$header_image = get_header_image();
				$header_image_data = get_theme_mod( 'header_image_data' );
				$header_image_alt = get_post_meta( $header_image_data->attachment_id, '_wp_attachment_image_alt', true );
			} else {
				$header_image = get_template_directory_uri() . '/assets/images/header.jpg';
				$header_image_alt = get_bloginfo( 'name' );
			}

			?>

			<figure class="header-image bg-image" style="background-image: url( <?php echo esc_url( $header_image ); ?> );">
				<img src="<?php echo esc_url( $header_image ); ?>"<?php if ( $header_image_alt ) : ?> alt="<?php echo esc_attr( $header_image_alt ); ?>"<?php endif; ?> />
			</figure>

		<?php endif; ?>

		<main id="site-content" class="site-content">