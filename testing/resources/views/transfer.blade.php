@include('layout.header')


<?php  
            $user = Auth::user();
         // print_r($user['account_id']);
      $payment =  "paymentmethod:".$user['payment_id']; ?>
		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">Transaction Hitory</h3>
				<p class="text-center welcome" ></p>
				<div class="loader_outer">
				<div class="loader"></div>
				<p>Transaction loading ...</p>
				</div>
				
					
				  <p class="account_info text-right">
				
				  </p>
                  
					<table class="table">
				  <thead>
				    <tr>
				   
				      <th scope="col">created at</th>
				      <th scope="col">Id</th>
				      <th scope="col">Destination</th>
				      <th scope="col">DestCurrency</th>
				      <th scope="col">DestAmount</th>
				      <th scope="col">status</th>

				    </tr>
				  </thead>
				  <tbody class = "transer_data">
				    
				  </tbody>
               </table>
			   
		    </div>
		</section>




<?php   $payment_methods = DB::table('payment_methods')->where('user_id', $user->id)->select("payment_id")->get(); ?>


<script type="text/javascript">
function convert(timestamp) {
  var date = new Date(                          // Convert to date
    parseInt(                                   // Convert to integer
      timestamp.split("(")[1]                   // Take only the part right of the "("
    )
  );
  return [
    ("0" + date.getDate()).slice(-2),           // Get day and pad it with zeroes
    ("0" + (date.getMonth()+1)).slice(-2),      // Get month and pad it with zeroes
    date.getFullYear()                          // Get full year
  ].join('/');                                  // Glue the pieces together
}




var acct_id= "<?php echo  Session::get('account_id'); ?>";
var payment= "<?php echo $payment ?>";
	$(document).ready(function(){
    var arr = [];
   <?php foreach ($payment_methods as $item) : ?>
   arr.push('<?php echo $item->payment_id?>');
   <?php endforeach; ?>
	$.ajax({
     type : 'GET',
      datatype:"json",
     headers: {
    'Authorization': "Bearer "+key,
   'Content-Type': 'application/json',
     },
 
     url : api_url+'/v3/transfers',
   
    success: function (data) {
    	
  //       $('.email').text(data.defaultCurrency)
  //     $('.city').text(data.status)
    
  //   $('.postal_code').text(data.countryCode)
  //  $('.name').text(data.linkType)
 
   var html = '';
 
    	
  $.each(data['data'], function(index1, value1){
 
 
var res = value1.source.split(":");
  console.log(res);
      if(jQuery.inArray(res[1], arr)>=0){
  // if(value1.source == payment+":ach"){
   html += '<tr><td>'+convert("/Date("+value1.createdAt+")/")+'</td>';
   html += '<td>'+value1.id+'</td>';

   html += '<td>'+value1.dest+'</td>';
   html += '<td>'+value1.destCurrency+'</td>';
   html += '<td>'+value1.destAmount+'</td>';
   html += '<td>'+value1.status+'</td></tr>';
   }
  
   });

    console.log(html);
$(".transer_data").html(html);
 $(".loader_outer").css("display","none");

   }

    });

	 })
</script>
</body>
</html>
