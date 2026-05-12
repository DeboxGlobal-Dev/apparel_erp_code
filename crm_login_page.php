<?php  
// echo "test4";die;
session_regenerate_id(); 
include "inc.php"; 
	
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) { 
$username = clean($_COOKIE['username']); 
$password = clean($_COOKIE['password']); 
$loginreturn = login($username,$password);  
if($loginreturn=='yes'){ 
header("Location: ".$fullurl.""); 
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
if($loginreturn=='yes'){ 

header("Location: ".$fullurl.""); 
exit(); 
}

 
if($loginreturn=='no'){  
$errormsg='Invalid Login';  
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
	<?php  include "headerinclude.php"; ?>

	
</head>

<body>

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
								<input name="password" type="password" class="form-control" id="password" placeholder="Password">
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

							  <a href="#" class="ml-auto">Forgot password1?</a>							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
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
						&copy; <?php echo date('Y'); ?>. <a href="#">Powered By </a> by <a href="http://www.deboxglobal.com" target="_blank">De Box Global</a>
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
