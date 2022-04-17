<?php
if (!isset($_SESSION)) {
	session_start();
}
include_once 'setbhs.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;}
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
								<!-- <a href="index.html"><img src="img/logo.png" alt=""></a> -->
								<a href='diagnose.php?lang=indo'><img src='img/indo.png'></a>
								<a href='diagnose.php?lang=eng'><img src='img/eng.png'></a>
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
							<img class="d-flex mx-auto img-fluid" src="img/diagnose.jpg" alt="">
						</div>
						<div class="col-lg-6">
							<div class="story-content">
								<h2><span class="sp-2"><?php echo $lang['basic']; ?></span></h2>
								<form  id = "p01" action="" method="post" enctype="multipart/form-data">
									<div class='input-fields'><?php echo $lang['nama'];?></br>
										<input type='text' name='nama' class='input-line-full-width'required></input></br>
										<div class='input-fields'><?php echo $lang['umur'];?></br>
											<input type='number' name="age"  min="6" max="60"></input required> <?php echo $lang['age-cont'];?></br>
											<div class='input-fields'><?php echo $lang['bb'];?></br>
												<input type='number' name="weight"  step="0.01" min="0" required></input> Kg</br>
												<div class='input-fields'><?php echo $lang['tb'];?></br>
													<input type='number' name="height" step="0.01" min ="45.0" required></input> Cm</br></br>
													<div class='radio'><?php echo $lang['jk'];?>
														<input type='radio' name="sex" value='male' required></input><?php echo $lang['jk-male'];?>
														<input type='radio' name="sex" value='female' required></input><?php echo $lang['jk-female'];?></br>
													</br>
													<input type = "submit" class="genric-btn primary circle arrow" name="upload"></input>
												</form>
												<?php
												include 'perhitungan.php';
												require('db.php');
												if(isset($_POST['upload'])){
													$id="";
													$nama = $_POST['nama'];
													$age = $_POST['age'];
													$weight = $_POST['weight'];
													$height = $_POST['height'];
													$heightnew = pembulatan($height);
													$sex = $_POST['sex'];
													$Z_score_pbu = index_pb($sex, $weight, $height, $age);
													$Z_score_bbpb = index_bb($sex, $weight, $height, $age);

													$query="INSERT INTO data_anak (nama, sex, weight, height, age, z_score_bbpb, z_score_pbu) VALUES ('$nama', '$sex', '$weight', '$heightnew', '$age', '$Z_score_bbpb', '$Z_score_pbu')";
													$result= mysqli_query($con, $query);

													if(!$result){
														echo '<script> location.replace("diagnose.php");</script>';
													}else{
														// echo "z score bb/pb: ".$Z_score_bbpb;
												// 		echo "im here";
														$id = mysqli_insert_id($con);
														if ($Z_score_bbpb >= 3){ //anak obesitas
										          // " direct ke pertanyaan gejala Obesitas ";
															echo '<script> location.replace("g1.php?id='.$id.'");</script>';
										        }elseif (3 < $Z_score_bbpb && $Z_score_bbpb > -2) { // normal di index BB/PB
										          if ($Z_score_pbu <= -2){
										            //" direct ke pertanyaan gejala Stunting ";
																echo '<script> location.replace("q2.php?id='.$id.'");</script>';
										          }
												// 			echo "and here";
										        }else{
										          //" direct ke pertanyaan gejala wasting ";
															echo '<script> location.replace("w2.php?id='.$id.'");</script>';
										      //  }echo "can't find place";

													}
												}}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						<!-- End Banner Area -->
						<!-- Strat Footer Area -->
						<footer class="section-gap">
							<div class="container">
								<div class="row pt-60">
									<div class="col-lg-3 col-sm-6">
										<div class="single-footer-widget">
											<h6 class="text-uppercase mb-20">Top Product</h6>
											<ul class="footer-nav">
												<li><a href="#">Managed Website</a></li>
												<li><a href="#">Manage Reputation</a></li>
												<li><a href="#">Power Tools</a></li>
												<li><a href="#">Marketing Service</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="single-footer-widget">
											<h6 class="text-uppercase mb-20">Navigation</h6>
											<ul class="footer-nav">
												<li><a href="#">Home</a></li>
												<li><a href="#">Main Features</a></li>
												<li><a href="#">Offered Services</a></li>
												<li><a href="#">Latest Portfolio</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="single-footer-widget">
											<h6 class="text-uppercase mb-20">Compare</h6>
											<ul class="footer-nav">
												<li><a href="#">Works & Builders</a></li>
												<li><a href="#">Works & Wordpress</a></li>
												<li><a href="#">Works & Templates</a></li>
											</ul>
										</div>
									</div>

									<div class="col-lg-3 col-sm-6">
										<div class="single-footer-widget">
											<h6 class="text-uppercase mb-20">Quick About</h6>
											<p>
												Lorem ipsum dolor sit amet, consecteturadipisicin gelit, sed do eiusmod tempor incididunt.
											</p>
											<p>
												+00 012 6325 98 6542 <br>
												support@colorlib.com
											</p>
											<div class="footer-social d-flex align-items-center">
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-dribbble"></i></a>
												<a href="#"><i class="fa fa-behance"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
									<p class="footer-text m-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</div>
							</div>
						</footer>
						<!-- End Footer Area -->
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
function noEmpty(){
    var message, x;
    message = document.getElementById("p01");
    message.innerHTML = "";
    x = document.getElementById("demo").value;
    try {
    if(x == "") throw <?php echo $lang['empty'];?>;
  }
}

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
