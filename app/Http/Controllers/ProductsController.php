<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Sells;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsValidation;
class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsValidation $request)
    {
        Products::create($request->all());
        $response = array(
            's' => 'success',
            'm' => __('msg.product_success'),
            't' => __('msg.success')
        );
        return response()->json($response);
    }

    public function ProductList()
    {
        $products = Products::all();
        return response()->json($products);
    }

    public function Rate(Request $request)
    {
        $id = $request->all()['product_id'];
        $product = Products::where('id', '=', $id)->first();
        $output = array(
            'rate' => $product->rate,
            'transport_rate' => $product->transport_rate
        );
        return response()->json($output);
    }

    public function ProductDetails(Request $request)
    {
        $id = $request->all()['id'];
        $product = Products::find($id);
        return response()->json($product);
    }

    public function UpdateProduct(Request $request)
    {
        $id = $request->all()['id'];
        $product = Products::find($id);
        $product->name = $request->all()['name'];
        $product->unit = $request->all()['unit'];
        $product->rate = $request->all()['rate'];
        $product->transport_rate = $request->all()['transport_rate'];
        $product->save();

        $response = array(
            's' => 'success',
            't' => __('msg.success'),
            'm' => __('msg.update_success')
        );

        return response()->json($response);
    }

    public function DeleteProduct(Request $request) 
    {
        $id = $request->all()['id'];
        $sells = Sells::where('product_id', '=', $id)->count();

        if($sells == 0){
            $product = Products::find($id);
            $product->delete();

            $response = array(
                's' => 'success',
                't' => __('msg.success'),
                'm' => __('msg.delete_success')
            ); 
        }else{
            $response = array(
                's' => 'error',
                't' => __('msg.error'),
                'm' => __('msg.delete_failed').' '.$sells.__('msg.product_delete_failed')
            );
        }

        return response()->json($response);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
