<?php /* /var/www/html/wyer/testing/resources/views/login.blade.php */ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		 <meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Create Account</title>
		<link rel="stylesheet" href="<?php echo e(asset('public')); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('public')); ?>/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Teko:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
  	var base_url = "<?php echo url('/'); ?>"
    var acc_id ;
  </script>
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
			<script src="js/respond.js"></script>
		<![endif]-->
	</head>
<body>
<header class="header">
		<div class="container">
			<div class="row">
				<aside class="col-xs-6">
						<img src="<?php echo e(asset('public')); ?>/images/logo.png" alt="" />
				</aside>
				<aside class="col-xs-6 text-right">
					<ul>
						<li><a href="<?php echo e(URL::to('/')); ?>/create_account">Create Account</a></li>
					
					</ul>
				</aside>
			</div>
		</div>
	</header>



<section class="inner_linkpages">
	<div class="container">
		
		<div class="col-md-10 col-md-offset-1">
			
			<div class="inner_linkouter">
				<div class="col-md-2 col-sm-2 col-xs-12 paddg_0_left">
					<div class="left_innerlink">
						<div class="left_innlinkcontnt">
						
							
							
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<?php if(Session::has('message')): ?>
<p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
<?php endif; ?>
						<div class="ryt_innerlink">
							<div class="inner_topsection">
								<h2 class="text-center">Login</h2>
								
							</div>
							<form method='post' id='login' class='login'  action="<?php echo e(asset('login')); ?>">
					            <?php echo e(csrf_field()); ?>

				
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" name='email'>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" name='password'>
							</div>
							<h5 class="text-center"><a href="<?php echo e(URL::to('/')); ?>/create_account">Create Account</a></h5>
							<div class="innerryt_linkbtn text-center"><input type='submit' value='submit' class="btn btn-block text-uppercase orange_btn" name='Submit'>	
							</div>

						</form>
						</div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 paddg_0_left">
					<div class="left_innerlink">
						<div class="left_innlinkcontnt">
						
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- 
<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->