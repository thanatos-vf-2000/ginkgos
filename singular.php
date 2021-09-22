<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner group">

		<div class="content">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : 
				
					the_post(); 
					
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post single' ); ?>>

						<div class="post-inner">

							<div class="post-header">

								<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

								<?php if ( is_single() ) ginkgos_post_meta(); ?>

							</div><!-- .post-header -->

							<?php if ( get_the_content() ) : ?>

								<div class="post-content entry-content">

									<?php

									the_content();

									wp_link_pages( array(
										'before'		=> '<p class="page-links"><span class="title">' . __( 'Pages:', 'ginkgos' ) . '</span>',
										'after'			=> '</p>',
										'link_before'	=> '<span>',
										'link_after'	=> '</span>',
										'separator'		=> '',
										'pagelink'		=> '%',
										'echo'			=> 1,
									) );
									?>

								</div><!-- .post-content -->

								<?php 
							endif;
							
							the_tags( '<div class="post-tags">', '', '</div>' ); 
							
							?>

						</div><!-- .post-inner -->

						<?php 
						
						if ( is_single() ) : 

							$prev_post = get_previous_post();
							$next_post = get_next_post();

							if ( $prev_post || $next_post ) : ?>

								<div class="post-navigation">
									<div class="post-navigation-inner group">

										<?php if ( $prev_post ) : ?>
											<div class="post-nav-prev">
												<p><?php _e( 'Previous', 'ginkgos' ); ?></p>
												<h4><a href="<?php the_permalink( $prev_post->ID ); ?>"><?php echo get_the_title( $prev_post ); ?></a></h4>
											</div>
										<?php endif; ?>
										
										<?php if ( $next_post ) : ?>
											<div class="post-nav-next">
												<p><?php _e( 'Next', 'ginkgos' ); ?></p>
												<h4><a href="<?php the_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post ); ?></a></h4>
											</div>
										<?php endif; ?>

									</div><!-- .post-navigation-inner -->
								</div><!-- .post-navigation -->

								<?php
							endif;
						endif;
							
						comments_template( '', true ); 
						
						if ( get_page_template_slug() == 'contact-form-template.php' ) :
							if ( get_theme_mod( 'contact-google-maps' ,ginkgos_option('contact-google-maps'))):
								$contact_address_street = get_theme_mod( 'contact-address-street' ,ginkgos_option('contact-address-street'));
								$contact_address = ($contact_address_street != '') ? $contact_address_street : '';
								$contact_address_city = get_theme_mod( 'contact-address-city' ,ginkgos_option('contact-address-city'));
								$contact_address .= ($contact_address_city != '') ? ', ' . $contact_address_city : '';
								$contact_address_country = get_theme_mod( 'contact-address-country' ,ginkgos_option('contact-address-country'));
								$contact_address .= ($contact_address_country != '') ? ', ' . $contact_address_country : '';
								$contact_address = rawurlencode($contact_address);
								echo '<div class="wp-block-columns"><div class="wp-block-column">';
								echo '<div style="width: width: 99%; margin: 0 auto;"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q='. $contact_address .'&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>';
								echo '</div></div>';
							endif;
							?>
							<div class="wp-block-columns container">
								<div class="wp-block-column is-vertically-aligned-center">
								<h2 class="hestia-title"><?php _e('Send us a message', 'ginkgos'); ?></h2>
									<script type="text/javascript" src="<?php echo GINKGOS_URL; ?>assets/js/contact-form.js"></script>
									<?php if(isset($emailSent) && $emailSent == true) { ?>

									<div class="thanks">
										<h1><?php _e('Thank you, ', 'ginkgos') . $name;?></h1>
										<p><?php _e('Your e-mail has been successfully sent. You will receive a reply shortly.', 'ginkgos');?></p>
									</div>

									<?php } else { ?>
										<?php if(isset($hasError) || isset($captchaError)) { ?>
											<p class="error"><?php _e('An error occurred while submitting the form.', 'ginkgos'); ?></p>
										<?php } ?>
									
										<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
									
											<ol class="forms">
												<li><label for="contactName"><?php _e('Name', 'ginkgos');?></label>
													<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
													<?php if(isset($nameError) && $nameError != '') { ?>
														<span class="error"><?php echo esc_html($nameError);?></span> 
													<?php } ?>
												</li>
												
												<li><label for="email"><?php _e('E-mail', 'ginkgos'); ?></label>
													<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
													<?php if(isset($emailError) && $emailError != '') { ?>
														<span class="error"><?php echo esc_html($emailError);?></span>
													<?php } ?>
												</li>
												
												<li class="textarea"><label for="commentsText"><?php _e('Comment', 'ginkgos');?></label>
													<textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
													<?php if(isset($commentError) && $commentError != '') { ?>
														<span class="error"><?php echo esc_html($commentError);?></span> 
													<?php } ?>
												</li>
												<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /><label for="sendCopy"><?php _e('Receive a copy of the message', 'ginkgos');?></label></li>
												<li class="screenReader"><label for="checking" class="screenReader"><?php _e('To send this form, do not enter anything in this field', 'ginkgos');?></label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
												<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" class="button big color1 round"><?php _e('Send', 'ginkgos');?></button></li>
											</ol>
										</form>
										<?php } ?>
								</div><!-- Form -->
								<div class="wp-block-column is-vertically-aligned-center">
								<div class="wp-block-columns">
									<div class="wp-block-column"></div>
									<div class="wp-block-columns contact" style="flex-basis:100%;display: inline;">

										<?php
										if ( get_theme_mod( 'contact-address' ,ginkgos_option('contact-address'))):
											$contact_address_street = get_theme_mod( 'contact-address-street' ,ginkgos_option('contact-address-street'));
											$contact_address = ($contact_address_street != '') ? $contact_address_street.'<br>' : '';
											$contact_address_city = get_theme_mod( 'contact-address-city' ,ginkgos_option('contact-address-city'));
											$contact_address .= ($contact_address_city != '') ? $contact_address_city. '</br>' : '';
											$contact_address_country = get_theme_mod( 'contact-address-country' ,ginkgos_option('contact-address-country'));
											$contact_address .= ($contact_address_country != '') ? $contact_address_country : '';
										?>
											<h4 class="fas fa-map has-text-align-left has-text-color" style="font-size:35px"><strong>Find us at the office</strong></h4>
											<p class="has-text-align-left has-text-color" style="color:#999999;font-size:14px"><?php echo $contact_address; ?></p>

											<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
										<?php endif; 
										if ( get_theme_mod( 'contact-phone' ,ginkgos_option('contact-phone'))):
											$contact_phone_name = get_theme_mod( 'contact-phone-name' ,ginkgos_option('contact-phone-name'));
											$contact_phone = ($contact_phone_name != '') ? $contact_phone_name.'<br>' : '';
											$contact_phone_number = get_theme_mod( 'contact-phone-number' ,ginkgos_option('contact-phone-number'));
											$contact_phone .= ($contact_phone_number != '') ? $contact_phone_number.'<br>' : '';
											$contact_phone_time = get_theme_mod( 'contact-phone-time' ,ginkgos_option('contact-phone-time'));
											$contact_phone .= ($contact_phone_time != '') ? $contact_phone_time : '';
										?>
											<h4 class="fas fa-phone has-text-align-left has-text-color" style="font-size:35px"><strong>Give us a ring</strong></h4>
											<p class="has-text-align-left has-text-color" style="color:#999999;font-size:14px"><?php echo $contact_phone; ?></p>

											<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
										<?php endif; 
										if ( get_theme_mod( 'contact-email' ,ginkgos_option('contact-email'))):
											$contact_email_name = get_theme_mod( 'contact-email-name' ,ginkgos_option('contact-email-name'));
											$contact_email = ($contact_email_name != '') ? $contact_email_name.'<br>' : '';
											$contact_email_address = get_theme_mod( 'contact-email-address' ,ginkgos_option('contact-email-address'));
											$contact_email .= ($contact_email_address != '') ? $contact_email_address : '';
										?>
											<h4 class="fas fa-at has-text-align-left has-text-color" style="font-size:35px"><strong>Give us a mail</strong></h4>
											<p class="has-text-align-left has-text-color" style="color:#999999;font-size:14px"><?php echo $contact_email; ?></p>

											<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
										<?php endif; 
										if ( get_theme_mod( 'contact-legal-info' ,ginkgos_option('contact-legal-info'))):
											$contact_legal_name = get_theme_mod( 'contact-legal-info-name' ,ginkgos_option('contact-legal-info-name'));
											$contact_legal = ($contact_legal_name != '') ? $contact_legal_name.'<br>' : '';
											$contact_legal_text_1 = get_theme_mod( 'contact-legal-info-text-1' ,ginkgos_option('contact-legal-info-text-1'));
											$contact_legal .= ($contact_legal_text_1 != '') ? $contact_legal_text_1.'<br>' : '';
											$contact_legal_text_2 = get_theme_mod( 'contact-legal-info-text-2' ,ginkgos_option('contact-legal-info-text-2'));
											$contact_legal .= ($contact_legal_text_2 != '') ? $contact_legal_text_2 : '';
										?>
											<h4 class="fas fa-info has-text-align-left has-text-color" style="font-size:35px"><strong>Legal information</strong></h4>
											<p class="has-text-align-left has-text-color" style="color:#999999;font-size:14px"><?php echo $contact_legal; ?></p>
										<?php endif; ?>
									</div><!-- columns -->
								</div><!-- columns -->
								</div><!-- Right Information -->
							</div>
							<?php
						endif;
						?>

					</article><!-- .post -->

					<?php
				endwhile;
			endif;


			?>

		</div><!-- .content -->

		<?php if ( get_page_template_slug() !== 'full-width-page-template.php' ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div><!-- .section-inner -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
