<?php
require('db.php');
include_once 'setbhs.php';

$id=mysqli_escape_string($con,$_GET['id']);
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="Colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>CellOn</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/nice-select.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<style>
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			padding-top: 100px; /* Location of the box */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
			position: relative;
			background-color: #fefefe;
			margin: auto;
			padding: 0;
			border: 1px solid #888;
			width: 80%;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
			-webkit-animation-name: animatetop;
			-webkit-animation-duration: 0.4s;
			animation-name: animatetop;
			animation-duration: 0.4s
		}

		/* Add Animation */
		@-webkit-keyframes animatetop {
			from {top:-300px; opacity:0}
			to {top:0; opacity:1}
		}

		@keyframes animatetop {
			from {top:-300px; opacity:0}
			to {top:0; opacity:1}
		}

		/* The Close Button */
		.close {
			color: white;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: #fefefe;
			text-decoration: none;
			cursor: pointer;
		}

		.modal-header {
			padding: 2px 16px;
			background-color: #C0F7FE;
			color: white;
		}

		.modal-body {padding: 2px 16px;}

		.modal-footer {
			padding: 2px 16px;
			background-color: #C0F7FE;
			color: white;
		}
	</style>
	<body>
		<div class="oz-body-wrap">
			<!-- Start Header Area -->
			<header class="default-header generic-header">
				<div class="container-fluid">
					<div class="header-wrap">
						<div class="header-top d-flex justify-content-between align-items-center">
							<div class="logo">
								<a href="index.html"><img src="img/logo.png" alt=""></a>
							</div>
							<div class="main-menubar d-flex align-items-center">
								<nav class="hide">
									<a href="home.php">Home</a>
									<a href="diagnose.php">Diagnose</a>
									<a href="elements.html">Elements</a>
								</nav>
								<div class="menu-bar"><span class="lnr lnr-menu"></span></div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- End Header Area -->
			<!-- Start Banner Area -->
			<section class="banner-area relative">
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-center">
						<div class="banner-left col-lg-6">
							<img class="d-flex mx-auto img-fluid" src="img/new.png" alt="">
						</div>
						<?php
						$sql ="select * from data_anak where id='$id'";
                        $query1 = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($query1)) {
                        	$cal_obese = $row['hasil_obese'];
                        	$cal_wasting = $row ['hasil_waste'];
                        	$cal_stunting = $row['hasil_stunt'];}
						if ($cal_obese > 50){?>
						<div class="col">
							<div class="story-content">
								<h1><span class="sp-1"><?php echo $lang['ob']; ?></span></h1>
								<h3><span class="sp-2"><?php $output = "";
										if ($cal_obese<=50.0){
											$output = $lang['output_1'];
										}elseif ($cal_obese<79.0) {
											$output = $lang['output_2'];
										}elseif ($cal_obese<99.0) {
											$output = $lang['output_3'];
										}else{
											$output = $lang['output_4'];
										}echo $output.$lang['ob'];?></span></h3><br>
									<span class="sp-2">Calculation: <?php echo $cal_obese; ?></span><br><br>
										<!-- <a href="diagnose.php" class="genric-btn primary circle arrow">Back To Diagnose</span></a> -->
									<br>
							</div><?php }
							if ($cal_wasting > 50){?>
								<div class="col">
								<div class="story-content">
									<h1><span class="sp-1">Wasting</span></h1>
										<h3><span class="sp-2"><?php $output = "";
										if ($cal_wasting<=50.0){
											$output = $lang['output_1'];
										}elseif ($cal_wasting<79.0) {
											$output = $lang['output_2'];
										}elseif ($cal_wasting<99.0) {
											$output = $lang['output_3'];
										}else{
											$output = $lang['output_4'];
										}echo $output."Wasting";?></span></h3><br>
										<span class="sp-2">Calculation: <?php echo $cal_wasting; ?></span><br><br>
											<!-- <a href="diagnose.php" class="genric-btn primary circle arrow">Back To Diagnose</span></a> -->
										<br>
								</div><?php }
								if ($cal_stunting > 50){?>
									<div class="col">
									<div class="story-content">
										<h1><span class="sp-1">Stunted</span></h1>
										<h3><span class="sp-2"><?php $output = "";
										if ($cal_stunting<=50.0){
											$output = $lang['output_1'];
										}elseif ($cal_stunting<79.0) {
											$output = $lang['output_2'];
										}elseif ($cal_stunting<99.0) {
											$output = $lang['output_3'];
										}else{
											$output = $lang['output_4'];
										}echo $output."Stunted";?></span></h3><br>
											<span class="sp-2">Calculation: <?php echo $cal_stunting; ?></span><br><br>
												<!-- <a href="diagnose.php" class="genric-btn primary circle arrow">Back To Diagnose</span></a> -->
											<br>
									</div><?php } 
								if (($cal_stunting == NULL) && ($cal_obese == NULL) && ($cal_wasting == NULL)){?>

										<div class="col">
										<div class="story-content">
											<h1><span class="sp-1">Normal</span></h1>
												<span class="sp-2"><?php echo $lang['output_1']; ?> Stunted , Wasting & <?php echo $lang['ob']; ?></span><br><br>
													<!-- <a href="diagnose.php" class="genric-btn primary circle arrow">Back To Diagnose</span></a> -->
												<br>
										</div><?php }
									elseif (($cal_stunting < 50) && ($cal_obese < 50 ) && ($cal_wasting < 50 )){?>
										
										<div class="col">
										<div class="story-content">
											<h1><span class="sp-1">Normal</span></h1>
												<span class="sp-2">Calculation Stunted: <?php echo $cal_stunting; ?></span><br><br>
												<span class="sp-2">Calculation Wasting: <?php echo $cal_wasting; ?></span><br><br>
												<span class="sp-2">Calculation <?php echo $lang['ob']; ?>: <?php echo $cal_obese; ?></span><br><br>
													<!-- <a href="diagnose.php" class="genric-btn primary circle arrow">Back To Diagnose</span></a> -->
												<br>
										</div><?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
</div>
<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/main.js"></script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
</body>

</html>
