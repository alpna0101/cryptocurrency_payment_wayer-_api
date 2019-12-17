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
  	var base_url = "<?php echo url('/'); ?>"
    var acc_id ;
  </script>
	<?php $key = "SK-JJMXQ7EU-CPE3DAX7-86GCMAF8-B9C2G3WL"; ?>
	</head>
    <body>

		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">Create Account</h3>
				<p class="text-center">Fill the information below to create account.</p>
				<div class="white_box">
				<div class="loader_outer">
					<div class="loader"></div>
					<p>Account creating ...</p>
				</div>
				<form method="POST" action="#" id="form">
				 <meta name="csrf-token" content="{{ csrf_token() }}">
				<input type="hidden" name="type" value="INDIVIDUAL"/><br/>
				   <input type="hidden" name="subaccount" value="true"/>
				   
			      		<div class="row">
				      		<div class="form-group col-sm-6">
				      		<input type="hidden" name="profileFields[0][fieldId]" value="individualLegalName"/>
								<label class="text-uppercase">User Name</label>
								<input class="form-control" name="profileFields[0][value]" type="text"  placeholder="Enter User Name" value="" required="true">
							</div>
						 <div class="form-group col-sm-6">
								 <input type="hidden" name="profileFields[1][fieldId]" value="individualEmail"/>
							<label class="text-uppercase">Email Address</label>
							<input class="form-control" name="profileFields[1][value]" type="email" value="" placeholder="Enter Email Address">
							</div> 
						</div>
						
						<div class="form-group">
						 <input type="hidden" name="profileFields[2][fieldId]" value="individualResidenceAddress"/>
							<label class="text-uppercase">Address</label>
							<input class="form-control" name="profileFields[2][value][street1]" type="text" value="" placeholder="Enter Street Address 1">
							<input class="form-control" name="profileFields[2][value][street2]" type="text" value="" placeholder="Enter Street Address 2">
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="text-uppercase">City</label>
								<div class="form-group">
								<input type="text" name="profileFields[2][value][city]" value="" class="form-control"/>
									<!-- <select>
										<option>Select City</option>
									</select> -->
								</div>
							</div>
							<div class="form-group col-sm-6">
								<label class="text-uppercase">State</label>
								<div class="form-group">
								  <input type="text" name="profileFields[2][value][state]" value=""  class="form-control"/>
								<!-- 	<select>
										<option>Select State</option>
									</select> -->
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="text-uppercase">Postal Code</label>
								<input class="form-control" name="profileFields[2][value][postalCode]" type="text"  placeholder="Enter Postal Code" value="">
							</div>
							 <input type="hidden" name="profileFields[2][value][country]" value="US" id="my_country"/>
							<div class="form-group col-sm-6">
								<label class="text-uppercase">Country</label>
								<div class="custom_select">
									<select name="country" required="true" id="country">
										
										<option value="US">US</option>
										<option value="CA">CA</option>
										<option value="AU">AU</option>
										<option value="IN">IN</option>
									</select>
								</div>
							</div>
						</div>
			        	<div class="row">
			        		<aside class="col-sm-6">
			        		  <input type="button" value="SUBMIT" onclick="create_account();"  class="btn btn-block text-uppercase orange_btn">
			        		
			        		</aside>
			        	</div>
			        </form>
			    </div>
		    </div>
		</section>




<script type="text/javascript">
$("#country").change(function(){
$("#my_country").val($(this).val());
 });
$(document).ready(function(){
	$(".loader_outer").css("display","none");
});
function create_account(){
   
    $(".loader_outer").css("display","block");
  var token = $('input[name="_token"]').val();
 
   $.ajax({
     type : 'POST',
      headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    url : base_url+'/postmydata',
    datatype:"json",
    data : $('#form').serializeArray(),
    success: function (result) {
    	var a = result;
    $.ajax({
     type : 'POST',
      datatype:"json",
     headers: {
    'Authorization': "Bearer SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA",
    'Content-Type': 'application/json',
     },
    data :  a,
     url : 'https://api.testwyre.com/v3/accounts',
   
    success: function (result1) {
       
    acc_id = result1.id;
   
    $.ajax({
     type : 'GET',
     datatype:"json",
    url : base_url+'/store_data?acc_id='+acc_id,
    
    success: function (result1) {
    	
 window.location = base_url+'/preview_account';
   
    }
   

    });
    },
     error: function (error) {
   	console.log(error.responseJSON.message);
    alert(error.responseJSON.message);
    }
   

    });
}

});  
}
</script>
</body>
</html>
