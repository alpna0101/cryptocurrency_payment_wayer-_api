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












}