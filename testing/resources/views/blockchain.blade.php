@include('layout.header')




		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">Attach Blockchain</h3>
				
				<div class="white_box">
					<form class="text-center" id="form1" enctype="multipart/form-data">
					 <meta name="csrf-token" content="{{ csrf_token() }}">
					  <select id="blockchain" required="true">
                    <option>Select blockchain</option>
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                   
                  </select>
					
						<div class="row">
			        		<aside class="col-sm-6 col-sm-offset-3">
			        			<input type="button" class="btn btn-block text-uppercase orange_btn" onclick="upload_doc()" value="SUBMIT">
			        		</aside>
			        	</div>
					</form>
			    </div>
		    </div>
		</section>






<script type="text/javascript">
var pay_id= "<?php  echo $_GET['id']  ?>"
function upload_doc(){
    
                   
  
     var mydata = {}; 
        mydata["blockchain"] = $("#blockchain").val();
  var myJsonString = JSON.stringify(mydata);
  console.log(myJsonString);
   $.ajax({
     type : 'POST',
      headers: {
    'Authorization': "Bearer "+key,
    'Content-Type': 'application/json',
     },

    url : api_url+"/v2/paymentMethod/"+pay_id+"/attach",
    datatype:"json",
    data : myJsonString,
     
    success: function (result) {
         
       
      window.location = base_url+'/preview_payment?id='+pay_id;
    // $.ajax({
    //  type : 'POST',
    //   datatype:"json",
    //  headers: {
    // 'Authorization': "Bearer SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA",
    // 'Content-Type': 'application/json',
    //  },
    // data :  a,
    //  url : 'https://api.sendwyre.com/v3/accounts',
   
    // success: function (result1) {
       
    // acc_id = result1.id;
    // }
   

    // });
}

});  
}
</script>


</body>
</html>
