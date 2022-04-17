<?php
   include("db.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myid = mysqli_real_escape_string($con,$_POST['id']);
      $password = mysqli_real_escape_string($con,$_POST['password']);

      $sql = "SELECT id FROM login WHERE id = '$myid' and password = '$password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //   $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         $_SESSION['loggedin'] = TRUE;
         $_SESSION['id']= "id";
         $_SESSION['login_user'] = $myid;
				//  echo "login berhasil";
         header("location: home.php");
      }else {
         echo "Your Login Name or Password is invalid";
      }
}
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
   <body bgcolor = "#FFFFFF">
   </br></br></br></br>
     <section class="banner-area relative">
       <div class="container">
     <div class="col-lg-12">
       <div class="story-content">
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "id" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
</section>


   </body>
</html>
