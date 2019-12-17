

@include('layout.header')


		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">Create Transfer</h3>
				<p class="text-center">Fill the information below to create account.</p>
				<div class="white_box">
				<div class="loader_outer">
					<div class="loader"></div>
					<p>Please wait ...</p>
				</div>
				<form method="POST" action="{{URL::to('/')}}/postmydata" id="form">
				 <meta name="csrf-token" content="{{ csrf_token() }}">
			<?php  
            $user = Auth::user();
            $payment_methods = DB::table('payment_methods')->where('user_id', $user->id)->select("payment_id")->get();
             ?>
			      		<div class="row">
				      		<div class="form-group col-sm-6">
				      		<input type="hidden" name="transfer[source]" id="select_payment" value=""/>
								<label class="text-uppercase">sourceAmount</label>
								<input class="form-control" name="transfer[sourceAmount]" type="text"  placeholder="Enter amount" >
							</div>
						 <div class="form-group col-sm-6">
								<label class="text-uppercase">Payment Method</label>
							<select name="payment_method" class="form-control" id="payment_m">
                            <option value="">Select Paymentmethod</option>
                         
							</select>
							</div> 
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
						
							<label class="text-uppercase">destCurrency</label>
							<select name="transfer[destCurrency]" class="form-control" id="dest_c">
                            <option value="">Select Currency</option>
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
							</select>
						
						</div>
						<div class="form-group col-sm-6">
				      		 <input type="hidden" name="transfer[sourceCurrency]" value="USD"/>
							<label class="text-uppercase">dest</label>
							<input class="form-control" id="dest" type="text" value="" placeholder="egmxYfAkXQBQMQAhnNLmpQb1ejDr1H8ZbpGt">
								<input class="form-control" id="dest_a" name="transfer[dest]" type="hidden" value="" placeholder="egmxYfAkXQBQMQAhnNLmpQb1ejDr1H8ZbpGt">
							<p> For BTC use "[address]"</p>
							<p> For ETH use "[address]"</p>
							</div>
					
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="text-uppercase">message</label>
								<div class="form-group">
								<input type="text" name="transfer[message]" value="San Francisco" class="form-control"/>
									<!-- <select>
										<option>Select City</option>
									</select> -->
								</div>
							</div>
							<div class="form-group col-sm-6">
								
								<div class="form-group">
								  <input type="hidden" name="transfer[autoConfirm]" value="true"  class="form-control"/>
								<!-- 	<select>
										<option>Select State</option>
									</select> -->
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
$(document).ready(function(){
	 var arr = [];
   <?php foreach ($payment_methods as $item) : ?>
   arr.push('<?php echo $item->payment_id?>');
   <?php endforeach; ?>
 console.log(arr);
	var payment_methods = <?php echo json_encode($payment_methods); ?>;

   console.log( 'Index : ' + jQuery.inArray("PA_3YXUYHUXEZV", arr));
	$(".loader_outer").css("display","none");
	$("#dest_c").change(function(){
		if($(this).val()=="BTC"){
           $("#dest_a").val("bitcoin:"+$("#dest").val())
		}else{
          $("#dest_a").val("ethereum:"+$("#dest").val())
		}


	})

	// console.log(payment_methods);
	var account_id = "<?php echo $user['account_id'] ?>";
	
 $.ajax({
     type : 'GET',
     datatype:"json",
     headers: {
   
     'Authorization': "Bearer "+key,
    'Content-Type': 'application/json',
     },

     url : api_url+'/v2/paymentMethods',
   
    success: function (result1) {
    	var html = "";
    	// console.log(result1);
    	 $.each(result1['data'], function(index1, value1){
         if(jQuery.inArray(value1.id, arr)>=0){

         	  html += '<option value="'+value1.id+'">xxxxxxx'+value1.last4Digits+'</option>'
                 
              
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
 	$("#select_payment").val("paymentMethod:"+$(this).val()+":ach");
   
 })
 

});
function create_account(){
   $(".loader_outer").css("display","block");
    
  var token = $('input[name="_token"]').val();
 
   $.ajax({
     type : 'POST',
      headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    url : base_url+'/transferdata',
    datatype:"json",
    data : $('#form').serializeArray(),
    success: function (result) {
    	var a = result;
    	       console.log(result);
    $.ajax({
     type : 'POST',
      datatype:"json",
     headers: {
    'Authorization': "Bearer SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA",
    'Content-Type': 'application/json',
     },
    data :  a,
     url : 'https://api.testwyre.com/v3/transfers',
   
    success: function (result1) {
       console.log(result1);
       window.location = base_url+'/transfer';
   
    },
   error: function (error) {
   	console.log(error.responseJSON.message);
    alert(error.responseJSON.message);
    window.location = base_url+'/create_transfer';

    }

    });
}

});  
}
</script>
</body>
</html>
