<?php
namespace App\Http\Controllers;

use GsmEncoder;
use LaravelSmpp\SmppServiceInterface;
use SMPP;
use SmppAddress;
use SmppClient;
use SocketTransport;

class SmsController extends Controller
{
    public function send()
    {
      info("called");
            if ($request->header('ip')){
                $ip = $request->header('ip');
            }else {
                $ip = '82.114.166.86';
            }
            if ($request->header('port')){
                $port = $request->header('port');
            }else {
                $port= 5016;
            } if ($request->header('sender')){
                $sender = $request->header('sender');
            }else {
                $sender= "sanaawater";
            }if ($request->header('to')){
                $to = $request->header('to'); 
            }else {$to = +967777151565; 
            }if ($request->header('message')){
                $umessage= $request->header('message'); 
            }else {
                $umessage= "sdsd الررر"; 
            }
            if ($request->header('user')){
                $user= $request->header('user'); 
            }else {
                $user= "United"; 
            }if ($request->header('password')){
                $password= (string)$request->header('password'); 
            }else {
                $password= "u@3n2"; 
            }

            

         

                $transport = new SocketTransport(array($ip),$port);
                $transport->setRecvTimeout(10000);
                $smpp = new SmppClient($transport);
                $smpp->debug = true;
                $transport->debug = true;
                $transport->open(); 
                $smpp->bindTransmitter($user,$password);
                $message = $umessage;
                $message2 =  iconv('utf-8','UCS-2BE',  $message);
                $from = new SmppAddress($sender,SMPP::TON_ALPHANUMERIC);
                $to = new SmppAddress($to,SMPP::TON_INTERNATIONAL,SMPP::NPI_E164);
        
                $result  = $smpp->sendSMS($from,$to,$message2);
               // $smpp->close();

                info("result is ");
                info ($result); 
                return "0000id=$result" ; 
              
    }
}
