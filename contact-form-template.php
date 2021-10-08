<?php
/*
Template Name: Contact Form
*/
?>


<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(isset($_POST['checking']) && trim(sanitize_text_field(wp_unslash($_POST['checking']))) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(isset($_POST['contactName']) && trim(sanitize_text_field(wp_unslash($_POST['contactName']))) === '') {
			$nameError = __('Enter your name.', 'ginkgos');
			$hasError = true;
		} else {
			$name = trim(sanitize_text_field(wp_unslash($_POST['contactName'])));
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(isset($_POST['email']) && trim(sanitize_email(wp_unslash($_POST['email']))) === '')  {
			$emailError = __('Enter a valid email address.', 'ginkgos');
			$hasError = true;
		} else if (!filter_var(trim(sanitize_email(wp_unslash($_POST['email']))), FILTER_VALIDATE_EMAIL)) {
			$emailError = __('Adresse e-mail invalide.', 'ginkgos');
			$hasError = true;
		} else {
			$email = trim(sanitize_email(wp_unslash($_POST['email'])));
		}
			
		//Check to make sure comments were entered	
		if(isset($_POST['comments']) && trim(sanitize_text_field(wp_unslash($_POST['comments']))) === '') {
			$commentError = __('Enter your message.', 'ginkgos');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$email_comments = stripslashes(trim(sanitize_text_field(wp_unslash($_POST['comments']))));
			} else {
				$email_comments = trim(sanitize_text_field(wp_unslash($_POST['comments'])));
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = get_theme_mod( 'contact-email-name' ,ginkgos_option('contact-email-name'));
			$subject = __('Contact form of ','ginkgos') . $name;
			$sendCopy = (isset($_POST['sendCopy']) ? trim(sanitize_text_field(wp_unslash($_POST['sendCopy']))) : '');
			$body = "Name: $name \n\nEmail: $email \n\nComments: $email_comments";
			$headers = 'De : mon site <'.$emailTo.'>' . "\r\n" . 'R&eacute;pondre &agrave; : ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = __('Contact form', 'ginkgos');
				$headers = 'De : <'. $emailTo .'>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} 

get_template_part( 'singular' );