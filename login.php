<?php 

	require_once("config.php");
	session_start();


	if(isset($_POST['submit'])){
		
		$users = $_POST['users'];
		$password = $_POST['password'];

		if(empty($users)){
			$err = "Insert Valide Email Or mobile";
		}
		else if(empty($password)){
			$err = "Password is required";
		}
		else{

			$password = sha1($password);
			$stmt = $conn->prepare("SELECT id,name,email,mobile,password FROM students WHERE (email=? OR mobile=?) AND password=?");
			$stmt->execute(array($users,$users,$password));
			 $count = $stmt -> rowCount();
			 if($count == 1){
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['user'] = $data;
			    $is_email_verified = Shahalom("is_email_verified", $_SESSION['user'][0]['id']);
				$is_mobile_vefified = Shahalom("is_mobile_verified", $_SESSION['user'][0]['id']);
				if($is_email_verified == 1 AND  $is_mobile_vefified == 1){

					header("location:dashboard/index.php");
				}
				else{
					header("location:verified.php");
				}
				
			 }
			 else{
				$err = "Your email, mobile, and password is wrong";
			 }
		}

	}
   

?>
<!--
User: codesnhq_psms_websites

Database: codesnhq_psms_websites
password:  MxND@[Y*I~pM



-->




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
	<meta name="description" content="PSMS - Student login" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS - Student login" />
	<meta property="og:description" content="PSMS - Student login" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS - St_Registration </title>
	
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
			<a href="index.php"><img src="assets/images/logo-white-1.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Student <span>Login</span></h2>
					<p>Don't have an account? <a href="registration.php">Registration Now</a></p>
				</div>	
				<form class="contact-bx" action="" method="POST">
					<div class="row placeani">
						<div class="col-lg-12">
							<?php if(isset($err)) :?>
								<div class="alert alert-warning"><?php echo $err; ?></div>
							<?php endif; ?>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Email OR Mobile</label>
									<input name="users" type="text"class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Password</label>
									<input name="password" type="password" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group form-forget">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
								</div>
								<a href="forget.php" class="ml-auto">Forgot Password?</a>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Login</button>
						</div>
					</div>
				</form>
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
