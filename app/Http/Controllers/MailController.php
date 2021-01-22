<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function Test(){
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail.test'], $data, function($message) {
         $message->to('absiddik517@gmail.com', 'Siddik')->subject
            ('Laravel Testing Mail');
         $message->from('kidorkarhmm@gmail.com','RBF Admin');
      });
      echo "Basic Email Sent. Check your inbox.";

    }
}
