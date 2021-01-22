<?php

namespace App\Http\Middleware;

use Closure;

use DB;
use App\Model\Users;
use App\User;
use App\Model\RulesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = Auth::user()->id;
        $users = DB::table('users')
                ->where('id', $id)
                ->join('rules', 'users.rule_id', '=', 'rules.id')
                ->join('permissions', 'rules.id', '=', 'permissions.rule_id')
                ->select('users.name', 'rules.name AS rule', 'permissions.insert_access', 'permissions.update_access', 'permissions.delete_access', 'permissions.rule_access', 'permissions.permission_access', 'permissions.user_access')
                ;//->get();
        dd($users);

        // return $next($request);
    }
}
