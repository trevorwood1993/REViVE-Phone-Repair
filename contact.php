<?php 


$data = [];
$data["covington"] = [];
$data["mandeville"] = [];

$data["covington"]["email"] = "ReviveCovington@gmail.com";
$data["covington"]["phone"] = "+1 985-302-5033";
$data["mandeville"]["email"] = "ReviveMandeville@gmail.com";
$data["mandeville"]["phone"] = "+1 985-624-4994";



if($_SERVER['REQUEST_METHOD'] == "POST"){

	$errors = [];

	$location = intval($_POST['location']);
	$name 		= htmlspecialchars(trim($_POST['name']));
	$email 		= htmlspecialchars(trim($_POST['email']));
	$address 	= htmlspecialchars(trim($_POST['address']));
	$message 	= htmlspecialchars(trim($_POST['message']));



	if($address != ""){
		$errors[] = "Address field should be empty";
	}

	if($location == 1){
		$send_to_this_email = $data["covington"]["email"];
	}else{
		$send_to_this_email = $data["mandeville"]["email"];
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
		<div class="contact_div">
			<h2>Covington</h2>
			<p><?php echo $data["covington"]["phone"]; ?></p>
			<p><?php echo $data["covington"]["email"]; ?></p>
		</div>
		<div class="contact_div">
			<h2>Mandeville</h2>
			<p><?php echo $data["mandeville"]["phone"]; ?></p>
			<p><?php echo $data["mandeville"]["email"]; ?></p>
		</div>
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
				<label for="location">Location</label>
				<select name="location" id="location">
					<option value="1">Covington</option>
					<option value="2">Mandeville</option>
				</select>
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
