<?php

namespace App\Http\Controllers;

use App\Model\DeleveryProduct;
use App\Model\Products;
use App\Model\Sells;
use App\Model\DuePay;
use Illuminate\Http\Request;
use App\Http\Requests\DueValidation;
use DB;
use Dates;
use Illuminate\Support\Facades\Auth;

class DuePayController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.due.form');
    }

    public function show()
    {
        return view('pages.due.show');
    }


    public function CustomerDetail(Request $request)
    {
        $ref = $request->all()['ref'];
        // init black variables
        $customer = [];
        $delever = [];


        $customerInfo = Sells::where('ref', '=', $ref)->get();
        $customer['name'] = $customerInfo->all()[0]['name'];
        $customer['address'] = $customerInfo->all()[0]['address'];
        $id = $customer['product_id'] = $customerInfo->all()[0]['product_id'];
        $customer['quantity'] = (int)$customerInfo->all()[0]['quantity'];
        $customer['rate'] = (int)$customerInfo->all()[0]['rate'];
        $customer['total'] = (int)$customerInfo->all()[0]['total'];
        $customer['due'] = (int)$customerInfo->all()[0]['due'];

        $product = Products::find($id)->first();
        $customer['product'] = $product['name'];

        $delivered = DuePay::where('ref', '=', $ref)->sum('amount');
        $customer['paid'] = (int)$delivered;
        return response()->json($customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SaveDue(DueValidation $request)
    {
        $data = $request->all();
        
        $data = Sells::where('ref', $request->ref)->first();
        $paid = DuePay::where('ref', $request->ref)->sum('amount');
        $presentdue = $data->total - $data->paid - $paid;
        
        if($request->amount < 1){
            $res = array(
                'm' => 'Amount should be more then 1 taka.',
                't' => 'Amount error',
                's' => 'error'
            );
        }else if($presentdue == 0){
            $res = array(
                'm' => 'Coustomer already pay all due',
                't' => 'Payment not added',
                's' => 'warning'
            );
        }else if($presentdue < $request->amount){
            $more = $request->amount - $presentdue;
            $res = [
                'm' => "You have entered $more taka more then customer due",
                't' => 'Amount Error', 
                's' => 'error'
            ];
          
        }else{
            DuePay::create([
              'ref'  => $request->all()['ref'],
              'description'  => $request->all()['description'],
              'amount'  => $request->all()['amount'],
              'user_id'  => Auth::user()->id,
              'date'  => Dates::Today()
            ]);
            
            $res = [
              //'m' => __('msg.duepay_success'),
              'm' => "Present Due : $presentdue",
              't' => __('msg.success'),
              's' => 'success'
            ];
        }
      
        return response()->json($res);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DuePay  $duePay
     * @return \Illuminate\Http\Response
     */
    public function DuePayHistory(Request $request)
    {
        $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.date').'</th><th>'.__('tbl.description').'</th><th>'.__('tbl.amount').'</th></tr></tbody>';

        $ref = $request->all()['ref'];
        $count = DuePay::where('ref', '=', $ref)->count();
        if($count > 0){
            $data = DuePay::where('ref', '=', $ref)->get();
            $i = 1;
            $total = 0;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["date"].'</td>';
                $table .= '<td>'.$key["description"].'</td>';
                $table .= '<td>'.$key["amount"].'</td>';
                $table .= '</tr>';
                $i++;
                $total += (int)$key['amount'];
            }
            $table .= '</tbody><tfoot>';
            $table .= '<tr><th colspan="3">'.__('tbl.total').'</th><th colspan="1">'.$total.'</th></tr></tfoot></table>';

        }else{
            $table .= "<tr><td colspan='4' style='text-align:center;'>".__('tbl.not_found')."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DuePay  $duePay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DuePay $duePay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DuePay  $duePay
     * @return \Illuminate\Http\Response
     */
    public function destroy(DuePay $duePay)
    {
        //
    }
}
