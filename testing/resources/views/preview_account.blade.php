@include('layout.header')
<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">My Account</h3>
				<p class="text-center welcome" ></p>
				<div class="loader_outer">
					<div class="loader"></div>
					<p>Profile loading ...</p>
				</div>
				<div class="white_box">
					<div class="row">
					<aside class="col-sm-4 ">
					</aside>
					<aside class="col-sm-4 "></aside>
				 
				  <aside class="col-sm-4 account_info">
				 <a href ="{{URL::to('/')}}/payment"> <input type="button" value="Add Payment"  class="btn btn-block text-uppercase orange_btn"></a>
				  </aside>
                    </div>
					<div class="row">
						<aside class="col-sm-6 account_info">
							<ul>
								<li>
									<label>Name</label>
									<p class="name">Ronan Thomas</p>
								</li>
								<li>
									<label>Email Address</label>
									<p class="email">ronan_thomas766@gmail.com</p>
								</li>
								<li>
									<label>Address</label>
									<p class="street1">102 Modal Town,</p>
									<p class="street2">Suite 402</p>
								</li>
								<li>
									<label>City</label>
									<p class="city">San Francisco</p>
								</li>
								<li>
									<label>State</label>
									<p class="state">CA</p>
								</li>
								<li>
									<label>Postal Code</label>
									<p class="postal_code">94105</p>
								</li>
								<li>
									<label>Country</label>
									<p  class="postal_code">US</p>
								</li>
								<li>
									<label>Uploaded Document</label>
									<p><a href="#">document.pdf</a></p>
								</li>
							</ul>
						</aside>
						<aside class="col-sm-6">
							<div class="balance_area">
								<h4>Total Balances</h4>
								<div class="box_balance">
									<h3><img src="{{asset('public')}}/images/bitcoin_icon.png">BTC</h3>
									<p class="btc">0.0000000</p>
								</div>
								<div class="box_balance">
									<h3><img src="{{asset('public')}}/images/eth_icon.png" alt="" />ETH</h3>
									<p class="eth">0.0</p>
								</div>
							</div>
							<h4>Deposit Address</h4>
							<div class="box_chain">
									
								</div>
						</aside>
					</div>
			    </div>
		    </div>
		</section>






<script type="text/javascript">

  var acct_id = "<?php echo  Session::get('account_id'); ?>";
//   var acct_id= "<?php  //echo "AC_6P3D42N48EG"  ?>"
 
	$(document).ready(function(){
	var myurl = api_url+'/v3/accounts/'+acct_id+'?masqueradeAs='+acct_id;
	var html ='';
$.ajax({
     type : 'GET',
      datatype:"json",
     headers: {
    'Authorization': "Bearer "+key,
    'Content-Type': 'application/json',
     },
  
      url : myurl,
   
    success: function (data) {
    	$(".loader_outer").css("display","none");
    	   
    	$('.btc').text(data.totalBalances.BTC)
        $('.eth').text(data.totalBalances.ETH)
        $('.email').text(data.profileFields[1].value)
        $('.city').text(data.profileFields[3].value.city)
        $('.street1').text(data.profileFields[3].value.street1)
        $('.street2').text(data.profileFields[3].value.street2)
       $('.state').text(data.profileFields[3].value.state)
       $('.postalCode').text(data.profileFields[3].value.postalCode)

       if(data.profileFields[2]['fieldId']=='individualLegalName'){
       	 $('.name').text(data.profileFields[2].value)
       }
       if(data.profileFields[3]['fieldId']=='individualLegalName'){
       	$('.name').text(data.profileFields[3].value)
       }
         if(data.profileFields[4]['fieldId']=='individualLegalName'){
       	$('.name').text(data.profileFields[4].value)
       }
       $('.welcome').text("Welcome!! "+data.profileFields[4].value)
       $.each(data.depositAddresses, function(index, value){

      html += '<div class="box_balance"><h3>'+index+'</h3><p>'+value+'</p>';
     $(".box_chain").html(html);
    });
  
 
    }
   

    });
	 })
</script>
</body>
</html>
