<?php
session_regenerate_id();
include "inc.php";

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
$username = clean($_COOKIE['username']);
$password = clean($_COOKIE['password']);
$loginreturn = login($username,$password);

if($loginreturn=='yes'){
// header("Location: ".$fullurl."");
header("Location: /showpage.crm?module=timeandaction");
exit();
}
}


if($_POST['username']!='' && $_POST['userpass']!=''){
$username = clean($_POST['username']);
$password = clean($_POST['userpass']);
if(isset($_POST['remember'])) {
setcookie('username', $username, time() + 60*24*60*60);
setcookie('password', $password, time() + 60*24*60*60);
} else {
setcookie('username', '', time() - 60*24*60*60);
setcookie('password', '', time() - 60*24*60*60);
}

  $loginreturn = login($username,$password);
// echo "tt";die;
if($loginreturn=='yes'){
// header("Location: ".$fullurl."");
header("Location: /showpage.crm?module=timeandaction");
exit;

}


if($loginreturn=='no'){
$errormsg='Invalid Login';
}
}

if($_POST['forgotemail']!=''){
include "config/mail.php";

$mail=$_POST['forgotemail'];


$select='*';
$where='email="'.$mail.'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$remail=$LoginUserDetails['email'];
$reuserid=$LoginUserDetails['id'];

if($remail!=''){


$subject='Reset Password Request - Woodland Appreal ERP!';
$description='Dear '.$LoginUserDetails['firstName'].' '.$LoginUserDetails['lastName'].'<br><br>You recently made a request to reset your password. Please click the link below to complete the process.<br><br><a href="'.$fullurl.'reset-password.php?u='.encode($reuserid).'">Reset now &gt;</a><br><br><img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">';


$fromemail='';
$mailto=$remail;
$mailsubject=$subject;
$maildescription=$description;


send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);


header("Location: login.crm?forgot=yes&alt=1");
$resetpassdiv=1;
exit();
} else {
$passwordnotavalible=1;

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
						<?php if($_GET['forgot']!='yes'){ ?>
							<div class="text-center mb-3">
							<div style="margin-bottom:10px;">
							<img src="<?php echo $fullurl;?>global_assets/images/<?php echo $logo; ?>" width="50%">
							</div>
								<!--<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>-->
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input name="username" type="text" class="form-control" id="username" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input name="userpass" type="password" class="form-control" id="userpass" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

						  <div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input name="remember" type="checkbox" class="form-input-styled" value="1" checked data-fouc>
										Remember
									</label>
								</div>

							  <a href="<?php echo $fullurl; ?>login.crm?forgot=yes" class="ml-auto" >Forgot password?</a>	</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							<?php }else{ ?>

							<div class="text-center mb-3">
							<div>
							<img src="<?php echo $fullurl;?>global_assets/images/modelama-logo.png" style="width:150px;">
							</div>
								<!--<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>-->
								<h5 class="mb-0">Forgots Passwords</h5>
								<?php if($_GET['alt']=='1'){?>
								<span class="d-block text-muted" style="color:#00CC00 !important;">Email has been sent successfully.</span>
								<?php } ?>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input name="forgotemail" type="text" class="form-control" id="forgotemail" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
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

							<?php } ?>

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
						&copy; <?php echo date('Y'); ?>. Powered By <a title="Debox Global It Solutions Private Limited" href="http://www.deboxglobal.com" target="_blank"><img src="<?php echo $fullurl;?>global_assets/images/debox-logo.png" style="width: 50px; margin-left: 5px;"></a>
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
