<?php  
session_regenerate_id(); 
include "inc.php"; 

if($_POST['userpass']!=''){
if($_POST['userpass'] == $_POST['confirmpass']){  
$password = clean($_POST['userpass']);  
$id= decode($_GET['u']);

$namevalue = 'password="'.md5($password).'"';
$where='id="'.$id.'"';  
$update = updatelisting(_USER_MASTER_,$namevalue,$where);  

if($update=='yes'){
//$errMsg = 'Password Reset Successfully.';
header("Location: reset-password.php?reset=1"); 
}

}else{
$errMsg = 'Password does not match.';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - <?php echo $systemname; ?></title>
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="global_assets/js/main/jquery.min.js"></script>
	<script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="assets/js/app.js"></script>
	<script src="global_assets/js/demo_pages/login.js"></script>
	<!-- /theme JS files -->

	
</head>

<body style="background-image:url(images/back.jpg); background-repeat:no-repeat; background-size:100% auto;">

	<!-- Main navbar -->
	 
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form" method="post" action="">
					<div class="card mb-0">
					
						<div class="card-body">
						
							
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Reset Password</h5>
								<?php if($_GET['reset']=='1'){?>
								<span class="d-block text-muted" style="color:#00CC00 !important;">Password reset successfully.</span>
								<?php } ?>
								
								<span class="d-block text-muted" style="color:red !important;"><?php echo $errMsg; ?></span>
							</div>
							
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input name="userpass" type="password" class="form-control" id="userpass" placeholder="Enter Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input name="confirmpass" type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							
							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										
									</label>
								</div>

							  <a href="<?php echo $fullurl; ?>login.crm" class="ml-auto" >Go Back To Login</a>	</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Submit <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							
							
						 
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <?php echo date('Y'); ?>. Powered By <a href="http://www.deboxglobal.com" target="_blank">De Box Global</a>
					</span>

					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item"><a href="http://deboxglobal.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
					</ul>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
