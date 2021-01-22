<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Workers;
use App\Model\WorkerAttendance;
use App\Model\WorkerPayment;
use App\Http\Requests\WorkerValidation;
use Illuminate\Support\Facades\Auth;
use Dates;

class WorkerAccountController extends Controller
{
    public function index($id){
        $count = Workers::where('id', $id)->count();
        if($count > 0){
            $worker = Workers::where('id', $id)->first();
            return view('pages.worker.account', ['id' => $id, 'worker' => $worker]);
        }else{
            return abort(404);
        }
    }
    
    public function accountDetail(Request $request){
        $id = $request['id'];
        $working_day = WorkerAttendance::where([['worker_id', '=', $id], ['status', '=', 'Present']])->count();
        $totalSelery = WorkerAttendance::where([['worker_id', '=', $id], ['status', '=', 'Present']])->sum('selery');
        $totalPaid = WorkerPayment::where('worker_id', $id)->sum('amount');
        $balance = $totalSelery - $totalPaid;
        
        $res = array(
            'days' => $working_day,
            'selery' => $totalSelery,
            'paid' => $totalPaid,
            'balance' => $balance
        );
        
        return response()->json($res);
    }
}
