<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Workers;
use App\Model\WorkerAttendance;
use App\Model\WorkerPayment;
use App\Http\Requests\WorkerValidation;
use Illuminate\Support\Facades\Auth;
use Dates;

class WorkersController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('pages.worker.index');
    }


    public function payments()
    {
    	return view('pages.worker.payments');
    }
    
    public function Store(WorkerValidation $request){
      Workers::create([
          'name'          => $request['name'],
          'address'       => $request['address'],
          'phone'         => $request['phone'],
          'designation'   => $request['designation'],
          'selery'        => $request['selery'],
          'user_id'       => Auth::user()->id,
          'date'          => date('Y-m-d'),
      ]);
      
      $res = [
        'm' => __('msg.worker_success'),  
        't' => __('msg.success'),  
        's' => 'success',  
      ];
      return response()->json($res);
    }
    
    public function UpdateWorker(Request $request){
        $id = $request['id'];
        Workers::where('id', $id)
            ->update([
                  'name'          => $request['name'],
                  'address'       => $request['address'],
                  'phone'         => $request['phone'],
                  'designation'   => $request['designation'],
                  'selery'        => $request['selery'],
                  
            ]);
            
        $res = array(
            't' => 'Success',
            'm' => 'Worker Details Update Successfull',
            's' => 'success'
        );
        return response()->json($res);
    }
    
    public function WorkerList(){
      $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.name').'</th><th>'.__('tbl.address').'</th><th>'.__('tbl.phone').'</th><th>'.__('tbl.selery').'</th><th>Action</th></tr></tbody>';
        $count = Workers::count();
        if($count > 0){
            $data = Workers::get();
            $i = 1;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["name"].'</td>';
                $table .= '<td>'.$key["address"].'</td>';
                $table .= '<td>'.$key["phone"].'</td>';
                $table .= '<td>'.$key["selery"].'</td>';
                $table .= '<td>
                            <a href="#" class="edit_worker" data-id="'.$key['id'].'">Edit</a>
                            <a href="#" class="attendance" data-id="'.$key['id'].'">Attendance</a>
                            <a href="#" class="payment" data-id="'.$key['id'].'">Payment</a>
                            <a href="'.route('worker.account', $key['id']) .'">Account</a>
                          </td>';
                $table .= '</tr>';
                $i++;
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='5' style='text-align:center;'>".__('__tbl.not_found')."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
    
    public function DetailsById(Request $request){
        $id = $request['id'];
        $data = Workers::where('id', $id)->first();
        $totalSelery = WorkerAttendance::where([['worker_id', '=', $id], ['status', '=', 'Present']])->sum('selery');
        $totalPaid = WorkerPayment::where('worker_id', $id)->sum('amount');
        $balance = $totalSelery - $totalPaid;
        
        $res = array(
            'name'     =>     $data['name'],
            'address'  =>     $data['address'],
            'phone'    =>     $data['phone'],
            'selery'   =>     $data['selery'],
            'designation'=>     $data['designation'],
            'balance'  =>     $balance
        );
        
        return response()->json($res);
    }
    
    public function storeAttendance(Request $request){
        $is_exist = WorkerAttendance::where([['worker_id', '=', $request['worker_id']] ,['date', '=', Dates::Today()]])->count();
        if($is_exist < 1){
            WorkerAttendance::create([
                'worker_id' => $request['worker_id'],
                'selery'    => $request['selery'],
                'status'    => $request['status'],
                'date'      => Dates::Today(),
            ]);
            
            $res = array(
                't' => $request['status'],
                'm' => 'Attendance details store successfull',
                's' => 'success'
            );
        }
        else{
            if($request['status'] == 'Present'){
                $selery = $request['selery'];
            }else{
                $selery = 0;
            }
            WorkerAttendance::where([['worker_id', '=', $request['worker_id']] ,['date', '=', Dates::Today()]])
            ->update(['selery' => $selery, 'status' => $request['status']]);
            
            $res = array(
                't' => $request['status'],
                'm' => 'Attendance update successfull',
                's' => 'success'
            );
        }
        
        return response()->json($res);
    }

    public function attendaneStatus(Request $request){
        $count = WorkerAttendance::where([['worker_id', $request['id']], ['date', Dates::Today()]])->count();
        $msg = '';
        $status = '';
        $seleryAmount = 0;
        if($count > 0){
            $worker = Workers::where('id', $request['id'])->first();
            $attendance = WorkerAttendance::where([
                ['worker_id', $request['id']], 
                ['date', Dates::Today()]
            ])->first();
            if($attendance['status'] == 'Present'){
                $msg .= $worker['name']. ' is '. $attendance['status'].' with selery '.$attendance['selery'].' taka.';
            }else if($attendance['status'] == 'Absent'){
                $msg .= $worker['name']. ' is '. $attendance['status'].'.';
            }
            $available = true;
            $status .= $attendance['status'];
            $seleryAmount = $attendance['selery'];
            
        }else{
            $available = false;
        }
        
        $res = array(
            'available'    =>  $available,
            'title'        =>  'Attendance already taken',
            'msg'          =>  $msg,
            'statuss'       =>  $status,
            'selery'       =>  $seleryAmount
        );
        
        return response()->json($res);
    }
}
