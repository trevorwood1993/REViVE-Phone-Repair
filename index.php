<?php 
$page_title = "Home - Revive Phone Repair";
include($_SERVER["DOCUMENT_ROOT"] . "/inc/header.php");


// error_reporting(-1);
// ini_set('display_errors', 'On');

?>


<div>
	

	<?php 
	$pathsToSlides = [//paths
		"/css/img/slide1.JPG",
		"/css/img/slide2.JPG",
		"/css/img/slide3.JPG",
		"/css/img/slide4.JPG",
		"/css/img/slide5.JPG",
		"/css/img/slide6.JPG",
		"/css/img/slide7.JPG",
		"/css/img/slide8.JPG"
	];
	$length = count($pathsToSlides);

	?>

	<div class="slideshow-container">

		<?php
		
		foreach ($pathsToSlides as $key => $path) {
			$slide = ""; 
			$index = $key+1;

			$slide .= '<div class="mySlides fade">';
			$slide .= 	'<div class="numbertext">'.$index.' / '.$length.'</div>';
			$slide .= 	'<img src="'.$path.'" style="width:100%">';
			$slide .= 	'<div class="text"></div>';
			$slide .= '</div>';
		
	   	echo $slide;
		
		}
		?>
	  
	  <!-- Next and previous buttons -->
	  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	  <a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>

	<div style="text-align:center">
		<?php 
		foreach ($pathsToSlides as $key => $path) {
			$index = $key+1;
			echo '<span class="dot" onclick="currentSlide('.$index.')"></span>'; 
		}
		?>
	</div>



	<div class="quick_and_reliable">
		<h2>Quick and Reliable Service</h2>
	</div>



	<div class="home_SWB_main basic_div">
		<div class="sub">
			<h2>Services</h2>
			<p>Most repairs can be done while you wait.  The average repair time for most iPhones is about 30 minutes.</p>
		</div>

		<div class="sub">
			<h2>Warranty</h2>
			<p>Every Product and service is covered for 1 year.  If something goes wrong on our end, bring it back and we'll replace it free of charge.</p>
		</div>

		<div class="sub">
			<h2>Buyback</h2>
			<p>Bring your old and broken smartphones in and get paid on the spot.  Give us a call, email us, or stop by for a free quote.</p>
		</div>
		<div style="clear:both;"></div>
	</div>


</div>

<script type="text/javascript" src="/js/index.js"></script>


<?php 
include($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php");
?>


