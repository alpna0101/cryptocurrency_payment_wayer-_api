@include('layout.header')

  <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
  <script src="https://verify.sendwyre.com/js/pm-widget-init.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $(".Navbar__button Navbar__button--is-right").click(function(){
alert("Dsdsad");
  });
});
    var handler = new WyrePmWidget({
      env: "test",
      onLoad: function(){
        // In this example we open the modal immediately on load. More typically you might have the handler.open() invocation attached to a button.
        handler.open();
      },
      onSuccess: function(result){
        var mydata = {}; 
        mydata["publicToken"] = result.publicToken;
        mydata["paymentMethodType"] = "LOCAL_TRANSFER";
          mydata["country"] = "US";
         var myJsonString = JSON.stringify(mydata);
         console.log(myJsonString);
       console.log(mydata);
      $.ajax({
       type : 'POST',
      headers: {
    'Authorization': "Bearer "+key,
    'Content-Type': 'application/json',
     },
   
    
    data :  myJsonString,
     url : api_url+'/v2/paymentMethods',
   
    success: function (data) {
        acc_id = data.id;
          
    $.ajax({
     type : 'GET',
      datatype:"json",
    
    data :  {acc_id:acc_id},
     url : base_url+'/store_data?payment_id='+data.id,
   
    success: function (result1) {
     window.location = base_url+'/preview_payment?id='+data.id;
   
    }
   

    });
    
      }
   

    });
     
      },
      onExit: function(err){
        if (err != null) {

          // The user encountered an error prior to exiting the module
        }else{
           window.location = base_url+'/preview_account';
        }
        console.log("Thingo exited:", err);
      }
    });
    
  </script>
</head>
<body>

</body>
</html>