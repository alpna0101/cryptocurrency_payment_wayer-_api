<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		 <meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Create Account</title>
		<link rel="stylesheet" href="{{asset('public')}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('public')}}/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Teko:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript">
  	 base_url = "<?php echo url('/'); ?>"
      api_url = "https://api.testwyre.com";
      key = "SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA";
  </script>
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
			<script src="js/respond.js"></script>
		<![endif]-->
	</head>
<body>

<?php $payment_id  = Session::get('payment_id');
    $key = "SK-FZDJQC9A-CYGLXZ8L-7Q6BL24M-P4WM8G2B

";


?>
	<header class="header">
		<div class="container">
			<div class="row">
				<aside class="col-xs-4">
				<img src="{{asset('public')}}/images/logo.png" alt="" />
					<!-- <h1 class="text-uppercase">Logo here</h1> -->
				</aside>
				<aside class="col-xs-8 text-right">
					<ul>
						<li><a href="{{URL::to('/')}}/preview_account">My Account</a></li>
						<li><a href="<?php echo URL::to('/')."/preview_payment?id=".$payment_id ?>">Blockchain Payout Method</a></li>
					<li><a href="{{URL::to('/')}}/create_transfer">Create Transfer</a></li>
					<li><a href="{{URL::to('/')}}/transfer">Transfer History</a></li>
						<li><a href="{{URL::to('/')}}/logout">Logout</a></li>
					</ul>
				</aside>
			</div>
		</div>
	</header>
