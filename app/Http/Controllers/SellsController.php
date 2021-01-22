<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sells;
use App\Model\Products;
use App\Http\Requests\SellsForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Dates;
use ProjectHelper;
class SellsController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function insertSell()
    {
        return view('pages.sells.sell-form');
    }
    
    public function viewAll()
    {
        $sells = Sells::with(['product', 'delevery', 'duePay'])->orderBy('id', 'DESC')->get();
        //dd($sells);
        return view('pages.sells.show', ['sells' => $sells]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sells.sell-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellsForm $request)
    {
        DB::table('sells')->insert([
        	'ref'			=> 	$request['ref'],
        	'name' 			=> 	$request['name'],
        	'address' 		=> 	$request['address'],
        	'phone' 		=> 	$request['phone'],
        	'product_id' 	=> 	$request['product_id'],
        	'quantity' 		=> 	$request['quantity'],
        	'rate' 			=> 	$request['rate'],
        	'transport_rate'=> 	$request['transport_rate'],
        	'product_price' => 	$request['product_price'],
        	'transport'     => 	$request['transport'],
        	'total' 		=> 	$request['total'],
        	'paid' 			=> 	$request['paid'],
        	'due' 			=> 	$request['due'],
            'user_id'       =>  Auth::user()->id,
            'date'          =>  Dates::Today()
        ]);

        
        $response = array(
            'm' => __('msg.sell_success'),
            't' => __('msg.success'),
            's' => "success"
        );

        return response()->json($response);
    }

    public function NewReference(Request $request)
    {
        $data = $request->all();
        $req = DB::table('sells')->select('ref')->orderBy('id','DESC')->limit(1)->get();
        return response()->json($req);
    }

    public function LastSell(Request $request)
    {
        // $data = DB::table('sells')->orderBy('id', 'DESC')->limit(1)->get();
        //$data = DB::table('sells')->join('products', 'sells.product_id', 'products.id')->select(['sells.*', 'products.name as products_name'])->orderBy('sells.id', 'DESC')->limit(1)->get();
        //return response()->json($data);
        
        $data = Sells::orderBy('id', 'desc')->limit(1)->first();
        $output = array(
            'name' => $data->name,
            'address' => $data->address,
            'phone' => $data->phone,
            'ref' => $data->ref,
            'product' => ProjectHelper::PName($data->product_id),
            'rate' => $data->rate .' | '.$data->transport_rate,
            'quantity' => $data->quantity,
            'product_price' => $data->product_price,
            'transport' => $data->transport,
            'total' => $data->total,
            'paid' => $data->paid,
            'due' => $data->total - $data->paid,
            'invoice' => '<a href="'.route('invoice.sell', $data->ref).'" class="btn btn-info btn-xs">Print</a>',
        );
        return response()->json($output);
    }
}


