<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$send_to_this_email = "REViVEphonerepair@yahoo.com";


	$errors = [];

	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$message = $_POST['message'];

	if($address != ""){
		$errors[] = "Address field should be empty";
	}

	if(!empty($name)){
		$name = substr($name,0,50);
	}else{
		$errors[] = "Name field is empty";
	}

	if(!empty($email)){
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		  //valid email
		} else {
		  $errors[] = "Not a valid email";
		}
	}else{
		$errors[] = "Email field is empty";
	}

	if(empty($message)){
		$errors[] = "Message field is empty";
	}

	if(empty($errors)){
		$subject = "Revive my Phone!";
		$message_body = 
		"Name: $name\nEmail: $email\nMessage: $message";

		$headers = 'From: webmaster@revivephonerepair.com' . "\r\n" .
    'Reply-To: '. $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

		mail($send_to_this_email, $subject, $message_body, $headers);
	
		header('Location: /contact?thanks');
	}


}else{
	if(isset($_GET['thanks'])){
		$email_sent = 1;
	}
}



$page_title = "Contact - Revive Phone Repair";
include($_SERVER["DOCUMENT_ROOT"] . "/inc/header.php");

?>

<div class="contact_main">
	<div class="hours">
		<h2>Hours:</h2>
		<p>MONDAY - FRIDAY: 9AM - 6PM</p>
		<p>SATURDAY: 10AM - 4PM</p>
		<p>SUNDAY: CLOSED</p>
	</div>

	<div class="contact_info">
		<p>Phone: (985)624-4994</p>
		<p>Email: REViVEphonerepair@yahoo.com</p>
		<div style="clear:both;"></div>
	</div>

	<?php 
	if(isset($email_sent)){
	?>

	<div class="thanks" id="scrollToMe">
		<p>Thank you. Your information has been submitted. We'll get back with you as soon as possible.</p>
	</div>

	<?php
	}else{
		if(isset($errors) && !empty($errors)){
			echo '<div class="contact_error" id="scrollToMe">';
			echo '<h3>Uh oh, there were some errors...</h3><ul>';
			foreach ($errors as $value) {
				echo '<li>'.$value.'</li>';
			}
			echo '</ul></div>';
		}
	?>

		<div class="contact_form">
			<h2 style="text-align:center;">Contact Form:</h2>
			<form action="/contact" method="post">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" <?php if(isset($name)){echo 'value="'.htmlspecialchars($name).'"';} ?>>
				<label for="email">Email</label>
				<input type="email" name="email" id="email" <?php if(isset($email)){echo 'value="'.htmlspecialchars($email).'"';} ?>>
				
				<div style="display:none;">
					<label for="address">Address</label>
					<input type="address" name="address" id="address">
				</div>
				
				<label for="message">Message</label>
				<textarea rows="5" name="message" id="message"><?php if(isset($message)){echo htmlspecialchars($message);} ?></textarea>
				<input type="submit" value="Send">
			</form>
		</div>

	<?php 
	}
	?>

</div>



<?php

if(isset($email_sent)){
	?>
		<script type="text/javascript">
			window.scrollTo(0,document.body.scrollHeight);
		</script>
	
	<?php
}else{
	if(isset($errors) && !empty($errors)){
	?>
		<script type="text/javascript">
			document.getElementById("scrollToMe").scrollIntoView();

			function scrollIntoView(eleID) {
		  	var e = document.getElementById(eleID);
		  	if (!!e && e.scrollIntoView) {
	      	e.scrollIntoView();
		  	}
			}
		</script>

	<?php
	}
}


include($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php");
?>