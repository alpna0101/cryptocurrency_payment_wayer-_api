@include('layout.header')




		<section class="form_outer">
			<div class="container">
				<h3 class="text-uppercase text-center">Upload Document</h3>
				<p class="text-center">Upload any of your valid identity document.</p>
				<div class="white_box">
					<form class="text-center" id="form1" enctype="multipart/form-data">
					 <meta name="csrf-token" content="{{ csrf_token() }}">
						<div class="upload_box">
							<input type="file" name="DOCUMENT" id="file" />
							<img  class="camera_icon"  src="{{asset('public')}}/images/camera_icon.png">
						
						</div>
						<p>Upload Documents</p>
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
acct_id="AC_446HGCB9PVB";
function upload_doc(){
   var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
     var formData = new FormData($('#form')[0]);
  var token = $('input[name="_token"]').val();
 
   $.ajax({
     type : 'POST',
      headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },

    url : base_url+'/upload_doc',
    datatype:"json",
    data : form_data,
      processData: false,
     contentType: false,
    success: function (result) {
         
       
         console.log(result);
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
