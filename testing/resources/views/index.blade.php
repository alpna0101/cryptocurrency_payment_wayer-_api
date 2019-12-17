
@include('layout.header')

<section class="form_outer">
      <div class="container">
        <h3 class="text-uppercase text-center">Create Account</h3>
        <p class="text-center">Fill the information below to create account.</p>
        <div class="white_box">
       

<form method="POST" action="{{URL::to('/')}}/postmydata" id="form">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="text" name="type" value="INDIVIDUAL"/><br/>
    <input type="text" name="country" value="US"/><br/>
    <input type="text" name="subaccount" value="true"/><br/>
    <input type="hidden" name="profileFields[0][fieldId]" value="individualLegalName"/>
    Name <input type="text" name="profileFields[0][value]" value="Johnny Quest"/><br/>
    <input type="hidden" name="profileFields[1][fieldId]" value="individualEmail"/>
   Email <input type="text" name="profileFields[1][value]" value="JohnnyQuest22@yolo.com"/><br/>
    <input type="hidden" name="profileFields[2][fieldId]" value="individualResidenceAddress"/>
    street1<input type="text" name="profileFields[2][value][street1]" value="1 Market St"/>
    street2<input type="text" name="profileFields[2][value][street2]" value="Suite 402"/>
    City<input type="text" name="profileFields[2][value][city]" value="San Francisco"/>
    <input type="text" name="profileFields[2][value][state]" value="CA"/>
   
      <div class="row">
        <div class="form-group col-sm-6">
                <label class="text-uppercase">Postal Code</label>
                <input class="form-control" name="profileFields[2][value][postalCode]" type="text"  placeholder="Enter Postal Code" value="94105">
              </div>
              <div class="form-group col-sm-6">
                <label class="text-uppercase">Country</label>
                <div class="custom_select">
                  <select name="profileFields[2][value][country]" required="true">
                    <option>Select Country</option>
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
    <input type="button" value="submit" onclick="create_account();"  class="btn btn-block text-uppercase orange_btn">
    </aside>
    </div>
  </form>
 </div>
  </div>
</section>
<script type="text/javascript">

function create_account(){
   
    
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
        alert(a);
         console.log(a);
    $.ajax({
     type : 'POST',
      datatype:"json",
     headers: {
    'Authorization': "Bearer SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA",
    'Content-Type': 'application/json',
     },
    data :  a,
     url : 'https://api.sendwyre.com/v3/accounts',
   
    success: function (result1) {
       
    acc_id = result1.id;
    }
   

    });
}

});  
}
</script>
