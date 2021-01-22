<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;

class ItemController extends Controller
{
    public function Rate(Request $req){
        $id = $req->all()['id'];
        $data = Item::where('id', $id)->first();
        $res = array(
                'rate' => $data['rate'],
                'action' => $data['action']
            );
        return response()->json($res);
        
    }
}
