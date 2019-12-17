<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DoorHanger;
use App\Customer;
use App\ContactUs;
use DB;
use Session;

class UserController extends Controller
{
  

public function logout(Request $request) {
  Auth::logout();
  return redirect('/');
}

  public function login(Request $request)
  {
    $email = request('email');
   $password = request('password');


  if(Auth::attempt(['email'=>$email,'password'=>$password]))
   {
      
       $id = Auth::id();
         
           $data  = User::where('id',$id)-> first();
            if(isset($data['payment_id'])){
            Session::put('payment_id', $data['payment_id']);
           }
         Session::put('account_id', $data['account_id']);
  
   
   
        return Redirect('/preview_account'); /**/

   }
   else
   {
    Session::flash('message','Invalid email/password');
     return Redirect('/');
   }



  }







  public function postmydata(Request $request)
  {
     $data_post = array();
    $data_post  = $_POST;
    
    $email = $_POST['profileFields'][1]['value'];
   $checkEmail = DB::table('users')->where('email',$email)->select('email')->first();
   if(!empty($checkEmail))
   {
   Session::flash('message','Email already exist');
   return Redirect('/create_profile');
   }
  $password1 ="netset@123";
  $password = Hash::make("netset@123");
  $user = new User;
  $user->name = $_POST['profileFields'][0]['value'];
  $user->email = $_POST['profileFields'][1]['value'];
  $user->password = $password;
  $save = $user->save();
   if(Auth::attempt(['email'=>$email,'password'=>$password1]))
   {
   }
   return  json_encode($data_post);


  }
   public function transferdata(Request $request)
  {
     $data_post = array();
   $data_post  = $_POST;
   $newdata = $data_post['transfer'];
   return  json_encode($newdata);


  }
  
 public function store_data(Request $request){
      $data_post = array();
     $data_post  = $_GET;
      $user = Auth::user();
    
   if(isset($data_post['payment_id'])){
   Session::put('payment_id', $data_post['payment_id']);
   echo $value = Session::get('payment_id');
   DB::table('users')->where('id', Auth::id())->update(['payment_id' =>$data_post['payment_id']]);
     // if($user->payment_id!=''){

     // }
    DB::table('payment_methods')->insert(
    ['payment_id' => $data_post['payment_id'], 'user_id' => $user->id]
     );
   
   }else{
    Session::put('account_id', $data_post['acc_id']);
    echo $value = Session::get('account_id');
   print_r($user);
  DB::table('users')->where('id', Auth::id())->update(['account_id' =>$data_post['acc_id']]);
   }
 
 
  
 }
 public function reteive_account(){
    $value = Session::get('account_id');
    // try to retrieve the current account
   $data = $this->make_authenticated_request("/v2/account/", "GET", array());
   print_r(  $data );die;
 }

 public function doc_test(){

 // perform a transfer
    $data_post = array(
      "upload-file"=>"/home/netset/Downloads/dumm.pdf",
      "DOCUMENT"=>"/home/netset/Downloads/dumm.pdf",
      "document"=>"/home/netset/Downloads/dumm.pdf"
      );

    // try to retrieve the current account
   $data = $this->make_authenticated_request("/v3/accounts/AC_446HGCB9PVB", "POST", $data_post);
   print_r(  $data );die;
 }


 function make_authenticated_request($endpoint, $method, $body) {


       $url = 'https://api.testwyre.com'; // todo use this endpoint for testwyre environment
        // $url = 'https://api.sendwyre.com';
      
        // todo please replace these with your own keys for the correct environment
         $api_key = "AK-XVRVP8CA-C36U9EQ7-CDCT64Q9-68LZZR2Z";
        $secret_key = "SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA";

        $timestamp = floor(microtime(true)*1000);
        $request_url = $url . $endpoint;

        if(strpos($request_url,"?"))
            $request_url .= '&timestamp=' . sprintf("%d", $timestamp);
        else
            $request_url .= '?timestamp=' . sprintf("%d", $timestamp);

        if(!empty($body))
            $body = json_encode($body, JSON_FORCE_OBJECT);
        else
            $body = '';

        $headers = array(
            "Content-Type: application/json",
            "X-Api-Key: ". $api_key,
            "X-Api-Signature: ". $this->calc_auth_sig_hash($secret_key, $request_url . $body)
        );
        $curl = curl_init();


        if($method=="POST"){
          $options = array(
            CURLOPT_URL             => $request_url,
            CURLOPT_POST            =>  true,
            CURLOPT_POSTFIELDS      => $body,
            CURLOPT_RETURNTRANSFER  => true);
        }else {
          $options = array(
            CURLOPT_URL             => $request_url,
            CURLOPT_RETURNTRANSFER  => true);
        }
        curl_setopt_array($curl, $options);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);
    
    
                   print_r(($result));
                   die;           
        if(curl_errno($curl)){
          echo 'Request Error:' . curl_error($curl);
          die;
        }


        curl_close($curl);
        var_dump($result);
        return json_decode($result, true);
    }

    function calc_auth_sig_hash($seckey, $val) {
        $hash = hash_hmac('sha256', $val, $seckey);
        return $hash;
    }

  public function upload_doc(Request $request){
    // echo '<pre>';print_r($_FILES);
// API key

// AK-9BDYXDJW-XUWDV4HB-WB67G3WZ-J6X9EQFJ

// Secret key

// SK-FDFBUY9W-V23PFJHE-3AHJ8WRR-AZ7GYAFU
     $url = 'https://api.testwyre.com';
      
        // todo please replace these with your own keys for the correct environment
        $api_key = "AK-XVRVP8CA-C36U9EQ7-CDCT64Q9-68LZZR2Z";
        $secret_key = "SK-LP7XQFU4-PT9PYGXZ-YQTGDDAC-A2VCG7LA";
        $timestamp = floor(microtime(true)*1000);
        $request_url = $url . "/v3/accounts";

        if(strpos($request_url,"?"))
            $request_url .= '&timestamp=' . sprintf("%d", $timestamp);
        else
            $request_url .= '?timestamp=' . sprintf("%d", $timestamp);

        if(!empty($body))
            $body = json_encode($body, JSON_FORCE_OBJECT);
        else
            $body = '';
            $hash = hash_hmac('sha256', $request_url, $secret_key);
            echo  $hash."test account";

$tempurl= "curl -X POST \
    'https://api.testwyre.com/v3/accounts/AC_446HGCB9PVB/individualGovernmentId?timestamp=".$timestamp."\
    --upload-file '/home/netset/Downloads/dumm.pdf' \
    -H 'Content-Type: application/pdf' \
    -H 'X-Api-Signature: ".$hash."' \
    -H 'X-Api-Key: AK-XVRVP8CA-C36U9EQ7-CDCT64Q9-68LZZR2Z'";
            

// Set some options - we are passing in a useragent too here
// curl_setopt_array($curl, [
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => 'https://api.testwyre.com/v3/accounts/AC_446HGCB9PVB/individualGovernmentId?timestamp='.$timestamp,
//     CURLOPT_USERAGENT => 'Codular Sample cURL Request',
//     CURLOPT_POST => 1,
//     CURLOPT_POSTFIELDS => [
//         "upload-file" => "/home/netset/Downloads/dumm.pdf",
       
//     ],


// ]);
//     echo $tempurl;
// $output = shell_exec($tempurl);
// echo $output;

$body = array(
  "individualGovernmentId" => "/home/netset/Downloads/dumm.pdf",
      );
 $headers = array(
            "Content-Type: application/json",
            "X-Api-Key: AK-XVRVP8CA-C36U9EQ7-CDCT64Q9-68LZZR2Z",
            "X-Api-Signature: ".$hash
        );
 // print_r( $headers);die;
$curl = curl_init();

        
          $options = array(
            CURLOPT_URL             => 'https://api.testwyre.com/v3/accounts/AC_446HGCB9PVB/individualGovernmentId?timestamp='.$timestamp,
            CURLOPT_POST            =>  true,
            CURLOPT_POSTFIELDS      => $body,
            CURLOPT_RETURNTRANSFER  => true);
      
        curl_setopt_array($curl, $options);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        
echo $result;
if(curl_errno($curl)){
    echo 'Request Error:' . curl_error($curl);
}
   curl_close($curl);
     

 }



    
}
