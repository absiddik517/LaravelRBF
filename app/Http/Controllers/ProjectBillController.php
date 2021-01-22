<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;
use App\Model\Products;
use App\Model\ProjectSell;
use App\Model\ProjectDelevery;
use App\Model\ProjectBills;
use App\Model\ProjectAdvance;
use App\Model\ProjectPayment;
// helper
use Dates;
use ProjectHelper;

class ProjectBillController extends Controller
{
    public function PaymentInfo(Request $req){
        $id = $req['id'];
        $data = ProjectPayment::where('id', $id)->first();
        $output = array(
            'description' => $data['description'],
            'amount' => $data['amount'],
        );
        
        return response()->json($output);
    }
    
    public function UpdatePayment(Request $req){
        if(ProjectHelper::isUpdatableProjectPayment($req['id'])){
            ProjectPayment::find($req['id'])->update([
                'description' => $req['description'],
                'amount' => $req['amount'],
            ]);
            
            $output = array(
                't' => 'Success',
                'm' => 'Payment update successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => 'Can not update payment of previous bill',
                's' => 'error',
            );
        }
        return response()->json($output);
    }
    
    public function DeletePayment(Request $req){
        if(ProjectHelper::isUpdatableProjectPayment($req['id'])){
            ProjectPayment::find($req['id'])->delete();
            $output = array(
                't' => 'Successful',
                'm' => 'Payment delete successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => 'Can not delete payment of previous bill.',
                's' => 'error'
            );
        }
        return response()->json($output);
    }
    
    public function AdvanceDetail(Request $req){
        $id = $req['id'];
        $data = ProjectAdvance::where('id', $id)->first();
        $output = array(
            'description' => $data['description'],
            'amount' => $data['amount'],
        );
        return response()->json($output);
    }
    
    public function UpdateAdvance(Request $req){
        if(ProjectHelper::isUpdatableProjectAdvance($req['id'])){
            ProjectAdvance::find($req['id'])->update([
                'description' => $req['description'],
                'amount' => $req['amount']
            ]);
            
            $output = array(
                't' => 'Successfull',
                'm' => 'Advance update successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'error',
                'm' => 'Can not update advance after submiting bill and previous bill',
                's' => 'error'
            );
        }
        return response()->json($output);
    }
    
    public function DeleteAdvance(Request $req){
        if(ProjectHelper::isUpdatableProjectAdvance($req['id'])){
            ProjectAdvance::find($req['id'])->delete();
            
            $output = array(
                't' => 'Successfull',
                'm' => 'Advance delete successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'error',
                'm' => 'Can not delete advance after submiting bill and previous bill',
                's' => 'error'
            );
        }
        return response()->json($output);
    }
    
}
