<?php

	require_once("config.php");
	session_start();
	if(!isset($_SESSION['user'])){
		header("location:login.php");
	}
	if(isset($_POST['email_send'])){
		$user_id = $_SESSION['user'][0]['id'];
		
		$rand_code = rand(9999,999999);
		
		$user_email = Shahalom('email', $user_id);
        $subject = "Php_emil_test";
        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>This email contains HTML Tags!</p>
        <table>
        <tr>
        <th>Firstname :Email_code : </th>
        <th>Roll : ".$rand_code."</th>
        </tr>
        </table>
        </body>
        </html>
        ";

		$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mail = mail($user_email,$subject,$message,$headers);

  
        if($mail == true){
            $success = "message send success";
        }
        else{
            $err = "Faild send message";
        }
      

		// Always set content-type when sending HTML email
		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		// $mail = mail($user_email,$subject,$message,$headers);
		// if($mail == true){
		// 	$stmt = $conn -> prepare("UPDATE students SET email_code=? WHERE id=?");
		//     $stmt -> execute(array($rand_code,$user_id));
		//     $success = "Email send success, Please check your email register email";
		// }
		// else{
		// 	$err = "Email code send faild";
		// }
	


	}



?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="PSMS - Student Verification" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS - Student Verification" />
	<meta property="og:description" content="PSMS - Student Verification" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS - Student Verification</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
	
</head>
<body id="bg">
<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
			<a href="index.php"><img src="assets/images/logo-white-2.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Student <span>Verification</span></h2>
					<p><?php echo Shahalom("name",$_SESSION['user'][0]['id']); ?> Please Verify Your Account</p>
				</div>	
				


				   <?Php 
				   	$is_email_status = Shahalom("is_email_verified", $_SESSION['user'][0]['id']);
					$is_mobile_status = Shahalom("is_mobile_verified", $_SESSION['user'][0]['id']);
				   ?>
		
			
					<p>Email:
						<?php 
							if($is_email_status == 1){
								echo "<span class='badge badge-success'>Email_is_verified</span>";
							}
							else{
								echo "<span class='badge badge-danger'>Email_not_verify</span>";
							}

						?>
		
					</p>
					<p>Mobile:
					<?php 
							if($is_mobile_status == 1){
								echo "<span class='badge badge-success'>Mobile_is_verified</span>";
							}
							else{
								echo "<span class='badge badge-danger'>Mobile_not_verify</span>";
							}

						?>	
					</p>


					<form class="contact-bx" method="POST" action="">
						<div class="row placeani"> 
							<div class="col-lg-12 m-b30">
								<button name="email_send" type="submit" class="btn button-md">Click to Verify Email</button>
							</div> 
						</div> 
					</form>

					<form class="contact-bx" method="POST" action="">
						<div class="row placeani">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Type Your Code</label>
										<input name="st_email_code" type="text"  class="form-control">
									</div>
								</div>
							</div>
							
							<div class="col-lg-12 m-b30">
								<button name="st_email_verify_btn" type="submit" value="Submit" class="btn button-md">Verify Email</button>
							</div>
						
						</div> 
					</form> 

				


				<!-- For Mobile Verification -->
			

		
<!-- 
				<form class="contact-bx" method="POST" action="">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Type Your Code</label>
									<input name="st_mobile_code" type="text"  class="form-control">
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 m-b30">
							<button name="st_mobile_verify_btn" type="submit" value="Submit" class="btn button-md">Verify Mobile Number</button>
						</div>
					
					</div> 
				</form> 
		 -->
	
			

				<!-- For Mobile Verification -->

			</div>
		</div>
	</div>
</div>
<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/contact.js"></script> 
</body>

</html>
