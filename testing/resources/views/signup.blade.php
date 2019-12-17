<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hireclassic car</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('public')}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('public')}}/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Teko:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body> 

<section class="linkpages_hedr">
	<nav class="navbar navbar_link_heder">
	  <div class="container">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.html"><img src="{{asset('public')}}/images/logo.png"></a>
		</div>
		<div class="alrdy_accunt pull-right">
			<p><span>Already have an Account?</span><a href="{{url('login')}}">LOGIN</a></p>
		</div>
	  </div>
	</nav>
</section>

<section class="inner_linkpages crete_accunt">
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<div class="inner_linkouter">
				
				<form method='post' id='signup' class='signup' enctype='multipart/form-data' action="{{asset('createProfile')}}">
					{{csrf_field()}}
						<div class="ryt_innerlink sign_u">
						<div class="inner_topsection text-center">
								<h2 class="text-center">SIGN UP</h2>
								<ul class="text-center">
									<li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
								<p class="text-center">Select Account type:</p>
								<div class="car_d text-center">
								 <label class="container1">Car Owner
								  <input checked="checked" name="usertype" type="radio" value="O">
								  <span class="checkmark"></span>
								</label>

								<label class="container1">Hire a Car
								 <input name="usertype" type="radio" value="C">
								  <span class="checkmark"></span>
								</label>
                              </div>
                                <div class="my_profile sign_profile">
                              <div class="avatar-upload">
									<div class="avatar-preview">
										<div id="imagePreview" style="background-image:url(./images/owner_profl.png);background-size: cover;">
										</div>
									</div>
									<div class="avatar-edit">
										<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name='image' />
										<label for="imageUpload"></label>
									</div>
								</div>
							</div>

						</div>
							<div class="form-group">
								<div class="row">

									<div class="col-sm-6">
								
						<label>Name</label>
						<input type="text" class="form-control" placeholder="Enter Name" name='name'>
					
							    </div>
							<div class="col-sm-6">
								<label>Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" name='email'>
							</div>
                            	
							</div>
							
							</div>

							<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label>Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" name='password' id='password'>
							</div>
							<div class="col-sm-6">
								<label>Confirm Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" name='confirmPassword'>
							</div>
						</div>
					</div>

						
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
						<label>Street</label>
						<input type="text" class="form-control" placeholder="Enter Street" name='street'>
					</div>
					<div class="col-sm-6">
                      
						<label>Town</label>
						<input type="text" class="form-control" placeholder="Enter Address" name='town'>
					
					</div>
					   </div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
						<label>Postcode</label>
						<input type="text" class="form-control" placeholder="Enter Address" name='postcode'>
					</div>
					<div class="col-sm-6">
						<label>Country</label>
						<select class="form-control" name='country'>
							<option value=''>Select Country</option>
							<option value='India'>India</option>
							<option value='USA'>USA</option>
						</select>
					</div>
				   </div>
				</div>
				
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
						<label>Phone Number</label>
						<input type="text" class="form-control" placeholder="Enter Phone Number" name='phone'>
					</div>
				
				
					<div class="col-sm-6">
						<label>Address</label>
						<input type="text" class="form-control" placeholder="Enter Address" name='address'>
					</div>
				    </div>
				</div>

				<div class="form-group">
								<label>About Me</label>
								<textarea class="form-control" name='aboutme'>Lorem Ipsum is simply dummy text. It has survived not only five centurie</textarea>
			    </div>


						<input type="text" class="form-control" placeholder="Enter Address" name='latitude' value='30.5456'>
						<input type="text" class="form-control" placeholder="Enter Address" name='longitude' value='76.4323'>    
				
					

					<div class="innerryt_linkbtn text-center">
							<input type='submit' value='submit' class="btn btn_more" name='Submit'>	
							</div>
						</div>

                     </form>




				
			</div>
		</div>
	</div>
</section>

@include('layout.footer')