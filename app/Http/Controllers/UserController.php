<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;

class UserController extends Controller
{
    function __construct()
    {
        return $this->middleware(['auth', 'permission']);
    }

    public function index()
    {
        $users = Users::with('UserRule')->get();
        return view('pages/users/index')->with('users', $users);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 
            'email' => 'required', 
            'phone' => 'required', 
            'id' => 'required', 
            'rule_id' => 'required'
        ]);

        $update = Users::where("id", $request->id)->update([
         "name"        =>  $request->name,
         "email"       =>  $request->email,
         "phone"       =>  $request->phone,
         "rule_id"     =>  $request->rule_id
       ]);

       return redirect()->route('users');
    }

    
    public function destroy($id)
    {
        //
    }
}
