@include('layout.header')



		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">MY PAYOUT METHOD</h3>
				<p class="text-center welcome" ></p>
				<div class="loader_outer">
				<div class="loader"></div>
				<p>Payment loading ...</p>
				</div>
				<div class="white_box">
				<?php  
            $user = Auth::user();

            $payment_methods = DB::table('payment_methods')->where('user_id', $user->id)->select("payment_id")->get();
             ?>
	<div class="row">
	<aside class="col-sm-6 account_info">
				  <select name="payment_method" class="form-control" id="payment_m">
                            <option value="">Select Paymentmethod</option>
                           <!--  <?php //if($user->id==2){?>
                     <option value="PA_ALMN2U9ED72">xxxxxxx0000</option>
                           <?php }
                            ?> -->

                         
							</select>	</aside>
							</div>
				  <p class="account_info text-right">
				 <a href ="{{URL::to('/')}}/blockchain?id={{ $_GET['id']}}" > <input type="button" value="Attach Blockchain Payout Address"  class="btn  text-uppercase orange_btn"></a>
				  </p>
                
					<div class="row">
						<aside class="col-sm-6 account_info">
							<ul>
								<li>
									<label>Payment Method</label>
									<p class="name"></p>
								</li>
								<li>
									<label>Default Currency</label>
									<p class="email"></p>
								</li>
								
							<li>
									<label>Status</label>
									<p class="city"></p>
								</li>
								<!-- <li>
									<label>State</label>
									<p class="state">CA</p>
								</li> -->
								<li>
									<label>Country</label>
									<p class="postal_code">94105</p>
								</li>
								
							</ul>
						</aside>
						<aside class="col-sm-6">
							
							<div class="balance_area">
								<h4>Attach BlockChains</h4>
								<div class="box_chain">
									
								</div>
							</div> 
						</aside>
					</div>
			    </div>
		    </div>
		</section>

	




<script type="text/javascript">
var pay_id= "<?php  echo $_GET['id']  ?>"

var acct_id= "<?php echo  Session::get('account_id'); ?>";

	$(document).ready(function(){
		var arr = [];
   <?php foreach ($payment_methods as $item) : ?>
   arr.push('<?php echo $item->payment_id?>');
   <?php endforeach; ?>
 
	var payment_methods = <?php echo json_encode($payment_methods); ?>;
	 $.ajax({
     type : 'GET',
     datatype:"json",
     headers: {
   
     'Authorization': "Bearer SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA",
    'Content-Type': 'application/json',
     },

     url : api_url+'/v2/paymentMethods',
   
    success: function (result1) {
    	var html = "";
    	// console.log(result1);
    	 $.each(result1['data'], function(index1, value1){
         if(jQuery.inArray(value1.id, arr)>=0){
             if (pay_id==value1.id){
             	 html += '<option value="'+value1.id+'" selected>xxxxxxx'+value1.last4Digits+'</option>'
             }else{
             	 html += '<option value="'+value1.id+'" >xxxxxxx'+value1.last4Digits+'</option>'
             }
         	 
                 
              // PA_ALMN2U9ED72
           }
          
            // if(value1.owner=="account:"+account_id){
            //  alert(value1.owner+"=="+"account:"+account_id);
            // }
         });
          $("#payment_m").append(html);
       // window.location = base_url+'/transfer';
   
    },
   error: function (error) {
   	console.log(error);
    }

    });
	 $("#payment_m").change(function(){
	 	pay_id = $(this).val();
	 	 var pageURL = $(location).attr("href");
	 	 var newurl  = pageURL.split('?')
	 	 window.location.href = newurl[0]+"?id="+pay_id;
	 	
	 })
	if(pay_id==''){
          alert("Please add payment method")
		 window.location = base_url+'/preview_account';
		}else{


$.ajax({
     type : 'GET',
      datatype:"json",
     headers: {
    'Authorization': "Bearer "+key,
   'Content-Type': 'application/json',
     },
 
     url : api_url+'/v2/paymentMethod/'+pay_id,
   
    success: function (data) {
        $('.email').text(data.defaultCurrency)
        $('.city').text(data.status)
        $('.postal_code').text(data.countryCode)
        $('.name').text(data.linkType)
        console.log(data.blockchains)
        var html = '';
      $.each(data.blockchains, function(index, value){

   html += '<div class="box_balance"><h3>'+index+'</h3><p>'+value+'</p>';
  $(".box_chain").html(html);
    });
   $(".loader_outer").css("display","none");

   }

    });
}
	 })
</script>
</body>
</html>
