<?php
/*
Template Name: Contact Form
*/
?>


<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = __('Enter your name.', 'ginkgos');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __('Enter a valid email address.', 'ginkgos');
			$hasError = true;
		} else if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
			$emailError = __('Adresse e-mail invalide.', 'ginkgos');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = __('Enter your message.', 'ginkgos');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = get_theme_mod( 'contact-email-name' ,ginkgos_option('contact-email-name'));
			$subject = __('Contact form of ','ginkgos') . $name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
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
?>

