<?php
	require_once("config.php");
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email= $_POST['email'];
		$onemail = strowCount('email',$email);
		$mobile=$_POST['mobile'];
		$onmobile = strowCount('mobile', $mobile);
		$father=$_POST['father'];
		$father_mobile=$_POST['father_mobile'];
		$on_father=strowCount("father_mobile",$father_mobile);
		$mother=$_POST['mother'];
		if(isset($_POST['gender'])){
			$gender = $_POST['gender'];
		}
		$birthday=$_POST['birthday'];
		$address=$_POST['address'];
		$password=$_POST['password'];
		if(empty($name)){
			$err="Name is required";
		}
		else if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $onemail != 0){
			$err = "Valide email is required";
		}
		else if(empty($mobile) || strlen($mobile) != 11 || $onmobile != 0){
			$err = "Your number is required";
		}
		else if(empty($father)){
			$err = "Father name is required";
		}
		else if(empty($father_mobile) || strlen($father_mobile) != 11 || $on_father != 0){
			$err = "Father number is invalide";
		}
		else if(empty($mother)){
			$err = "Mother name is required";
		}
		else if(empty($gender)){
			$err = "Gender select is required";
		}
		else if(empty($birthday)){
			$err = "Birthday is required";
		}
		else if(empty($address)){
			$err = "Your address is required";
		}
		else if(empty($password)){
			$err = "Password is required";
		}
		else{
			$password = sha1($password);
			$birthday = date("Y-m-s H:i:s");
			$stmt = $conn -> prepare("INSERT INTO students(name,email,mobile,father,father_mobile,mother,gender,birthday,address,password) VALUES(?,?,?,?,?,?,?,?,?,?)");
			$result = $stmt->execute(array($name,$email,$mobile,$father,$father_mobile,$mother,$gender,$birthday,$address,$password));
			if($result == true){
				$success = "Your Registration Is Success";
			}
			else{
				$err = "Faild Your Registration";
			}
		}
		
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
	<meta name="description" content="PSMS_Student_Registration" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS_Student_Registration" />
	<meta property="og:description" content="PSMS_Student_Registration" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS_Student_Registration</title>
	
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
					<h2 class="title-head">Student <span>Registration</span></h2>
					<p>Login Your Account <a href="login.php">Click here</a></p>
				</div>	
				<form class="contact-bx" action="" method="POST" enctype="multipart/form-data">
					<div class="row placeani">
						<div class="col-lg-12">
							<?php if(isset($success)) :?>
								<div class="alert alert-success"><?php echo $success;?></div>
							<?php endif; ?>
							<?php if(isset($err)) :?>
								<div class="alert alert-warning">
									<?php echo $err; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Student_Name</label>
									<input name="name" type="text" class="form-control" 
									value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Email Address</label>
									<input name="email" type="email" class="form-control"
									value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Mobile_Number</label>
									<input name="mobile" type="text" class="form-control"
									value="<?php if(isset($_POST['mobile'])){echo $_POST['mobile'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Father's_Name</label>
									<input name="father" type="text" class="form-control"
									value="<?php if(isset($_POST['father'])){echo $_POST['father'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Father's_Mobile</label>
									<input name="father_mobile" type="text" class="form-control"
									value="<?php if(isset($_POST['father_mobile'])){echo $_POST['father_mobile'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input name="mother" type="text" class="form-control" value="<?php if(isset($_POST['mother'])){echo $_POST['mother'];} ?>">
								<div class="input-group">
									<label>Mother's_Name</label>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
							
									<label>Gender : </label>&nbsp; &nbsp;
									<label><input type="radio" value="male" name="gender" style="margin-right:3px">Male</label> &nbsp;
									<label><input type="radio" value="female" name="gender" style="margin-right:3px">Female</label>
					
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group" style="display:flex; align-items:center">
						
									<label>Birthday</label>
									<input name="birthday" type="date" class="form-control" style="margin-left:25px" value="<?php if(isset($_POST['birthday'])){echo $_POST['birthday'];} ?>">
							
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Student_Address</label>
									<input name="address" type="text" class="form-control" value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>">
								</div>
							</div>
						</div> 
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="password" type="password" class="form-control" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="submit" type="submit" value="Submit" class="btn button-md">Registration</button>
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
