<?php

namespace App\Http\Controllers;

use App\Model\DeleveryProduct;
use App\Model\Products;
use App\Model\Sells;
use Illuminate\Http\Request;
use App\Http\Requests\Delivery;
use App\Model\ProjectDelevery;
use DB;
use Dates;
use Illuminate\Support\Facades\Auth;

class DeleveryProductController extends Controller
{
	function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function insertDelevery()
    {
        return view('pages.delevery.form');
    }

    public function viewAll()
    {
        $deleveries = DeleveryProduct::with('sellsRel')->get();
        //dd($deleveries);
        return view('pages.delevery.show', ['deleveries' => $deleveries]);
    }

    public function ChechRef(Request $request)
    {
        $ref = $request->all()['ref'];
        if(Sells::where('ref', '=', $ref)->count() > 0){
            $sells = Sells::where('ref', '=', $ref)->get();
            $name = $sells[0]['name'];
            $address = $sells[0]['address'];
            $product = $sells[0]['product_id'];
            $quantity = $sells[0]['quantity'];

            $response = array(
                'isValid' => true,
                'name' => $name,
            );
        }else{
            $response = array(
                'isValid' => false,
                'name' => __('tbl.not_found')
            );
        }

        return response()->json($response);

    }

    public function deliveryNext(Request $request)
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

        $product = Products::find($id)->first();
        $customer['product'] = $product['name'];

        $delivered = DeleveryProduct::where('ref', '=', $ref)->sum('quantity');
        $customer['delivered'] = (int)$delivered;
        return response()->json($customer);

    }

    public function newDRef(Request $request)
    {
        $delevery = DeleveryProduct::orderBy('id', 'DESC')->get()->first();
        $project = ProjectDelevery::orderBy('id', 'DESC')->get()->first();
        $last = 0;
        $del = $delevery['d_ref'] ?? 0;
        $pro = $project['dref'] ?? 0;
        if($del > $pro){
            $last = $del;
        }else{
            $last = $pro;
        }
        return response()->json($last + 1);
    }

    public function SaveDelivery(Delivery $request)
    {
        DB::table('delevery_products')->insert([
            'ref'           =>  $request['ref'],
            'd_ref'         =>  $request['d_ref'],
            'quantity'      =>  $request['quantity'],
            'driver'        =>  $request['driver'],
            'destination'   =>  $request['destination'],
            'user_id'       =>  Auth::user()->id,
            'date'          =>  Dates::Today()
        ]);

        $response = [
            't' => __('msg.delevery_success'),
            'm' => __('msg.success'),
            's' => 'success'
        ];

        return response()->json($response);
    }

    public function DeliveryHistory(Request $request)
    {
        $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>'.__('tbl.dref').'</th><th>'.__('tbl.quantity').'</th><th>'.__('tbl.driver').'</th><th>'.__('tbl.destination').'</th></tr></tbody>';

        $ref = $request->all()['ref'];
        $count = DeleveryProduct::where('ref', '=', $ref)->count();
        if($count > 0){
            $data = DeleveryProduct::where('ref', '=', $ref)->get();
            $i = 1;
            $total = 0;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["d_ref"].'</td>';
                $table .= '<td>'.$key["quantity"].'</td>';
                $table .= '<td>'.$key["driver"].'</td>';
                $table .= '<td>'.$key["destination"].'</td>';
                $table .= '</tr>';
                $i++;
                $total += (int)$key['quantity'];
            }
            $table .= '</tbody><tfoot>';
            $table .= '<tr><th colspan="2">'.__('tbl.total').'</th><th colspan="3">'.$total.'</th></tr></tfoot></table>';

        }else{
            $table .= "<tr><td colspan='5' style='text-align:center;'>".__('tbl.not_found')."</td></tr></tbody></table>";
        }
        return response()->json($table);
    }
}
