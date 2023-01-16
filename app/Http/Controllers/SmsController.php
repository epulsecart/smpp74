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
                $transport = new SocketTransport(array('161.97.167.60'),12345);
                $transport->setRecvTimeout(10000);
                $smpp = new SmppClient($transport);
                $smpp->debug = true;
                $transport->debug = true;
                $transport->open();
                info("the trans status is ");
                info ($transport->isOpen());
                $smpp->bindTransmitter("yahya","12345");
                $message = 'H€llo world';
                $encodedMessage = GsmEncoder::utf8_to_gsm0338($message);
                $from = new SmppAddress('yahya',SMPP::TON_ALPHANUMERIC);
                $to = new SmppAddress(771221030,SMPP::TON_INTERNATIONAL,SMPP::NPI_E164);
                $smpp->sendSMS($from,$to,$encodedMessage);
                $smpp->close();
                // $smpp = new SMPP();
                // $smpp->connect();

        // $this->$smpp->sendOne(1234567890, 'Hi, this SMS was send via SMPP protocol');
    }
}
