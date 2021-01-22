<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Rules;
use App\Http\Requests\RequestPermission;
use App\Model\RulesModel;
use App\Model\Permissions;

class RuleController extends Controller
{

    function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = (new RulesModel())->all();
        return view('pages.rules.list')->with('rules', $rules);
    }

    public function store(Rules $request)
    {
        $rule = new RulesModel();
        $rule['name'] = $request->name;

        if($rule->save()){
            $permission = new Permissions();
            $permission['rule_id'] = $rule->id;
            $permission->save();
            return redirect()->route('rules');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rule = (new RulesModel())->find($request->all()['id']);
        $rule['name'] = $request->name;

        if($rule->save()){
            return redirect()->route('rules');
        }
    }

    public function permission()
    {
        $rules = RulesModel::with('PermissionRel')->get();
        // dd($rules->all());
        return view('pages.rules.add_role')->with('rules', $rules);
    }

    public function createPermission(RequestPermission $request)  
    {
    
       $update = Permissions::where("rule_id", $request->rule_id)->update([
         "insert_access"        =>  $request->insert_access,
         "update_access"        =>  $request->update_access,
         "delete_access"        =>  $request->delete_access,
         "rule_access"          =>  $request->rule_access,
         "permission_access"    =>  $request->permission_access,
         "user_access"          =>  $request->user_access
       ]);

       return redirect()->route('permission');

    }
}
