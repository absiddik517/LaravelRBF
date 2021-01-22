<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\WorkerPayment;
use App\Model\WorkerAttendance;
use Illuminate\Support\Facades\Auth;
use Dates;

use App\Http\Requests\WorkerPaymentValidation;


class WorkerPaymentController extends Controller
{
    public function Store(WorkerPaymentValidation $request){
      $id = $request['worker_id'];
      $totalSelery = WorkerAttendance::where([['worker_id', '=', $id], ['status', '=', 'Present']])->sum('selery');
      $totalPaid = WorkerPayment::where('worker_id', $id)->sum('amount');
      $balance = $totalSelery - $totalPaid;
      $over = $request['amount'] - $balance;
      if($balance >= $request['amount']){
          WorkerPayment::create([
              'worker_id'    => $request['worker_id'],
              'amount'       => $request['amount'],
              'date'         => Dates::Today(),
              'user_id'      => Auth::user()->id
          ]);
            
          $res = [
            'm' => __('msg.worker_pay_success'),  
            't' => __('msg.success'),  
            's' => 'success',  
          ];
      }else{
          $res = [
            'm' => "You are tring to pay $over taka more then his balance",  
            't' => "Error Occured!",  
            's' => 'error',  
          ];
      }
      return response()->json($res);
    }
}
