<?php

namespace App\Http\Middleware;

use Closure;

use Sentinel;
use App\RoleUser;

class AdminMiddleware
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
        // return response()->json(['error'=>"Rafi"],400);
        $prefix = $request->route()->getPrefix();
        $prefix = substr($prefix, 1);
        if($prefix=="contacts"){
            $prefix = "contact";
        }

        if($prefix=="payment-receive"){
            $prefix = "payment";
        }
        
        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);

        $models = ["contact"=>"App\Contact","category"=>"App\ProjectCategory","project"=>"App\Project",
                  "purpose"=>"App\Models\Account\Account","income"=>"App\Models\MoneyIn\Income",
                  "expense"=>"App\Models\MoneyOut\Expense","payment"=>"App\Models\MoneyIn\PaymentReceive","invoice"=>"App\Models\MoneyIn\Invoice"];

        $request_field = $prefix.'_id';
        

        if ($request->isMethod('post')) {
            if ($role->hasAccess([$prefix.'.create']))
            {
                return $next($request);
            }
            else{
                return response()->json(['error'=>"You have no access"],400);
            }
        }
        elseif ($request->isMethod('put')) {
            $data = $models[$prefix]::find($request->$request_field);
            $created_by = $data->created_by;
            if($created_by == $user_id){
                
                if($role->hasAccess([$prefix.'.updateall']))
                {
                    return $next($request);
                }
                elseif($role->hasAccess([$prefix.'.update']))
                {
                    return $next($request);
                }
                else{
                    return response()->json(['error'=>"You have no access"],400);
                }
            }else{
                
                if ($role->hasAccess([$prefix.'.updateall']))
                {
                    return $next($request);
                }
                else{
                    return response()->json(['error'=>"You have no access"],400);
                }
            }
            
           
        }
        elseif ($request->isMethod('delete')) {
            $id = $request->route('id');
            if($prefix == 'contact'){
                $data = $models[$prefix]::where('user_id',$id)->first();
            }
            else{
                $data = $models[$prefix]::find($id);
            }
            $created_by = $data->created_by;
            if($created_by == $user_id){
                if($role->hasAccess([$prefix.'.deleteall']))
                {
                    return $next($request);
                }
                elseif($role->hasAccess([$prefix.'.delete']))
                {
                    return $next($request);
                }
                else{
                    return response()->json(['error'=>"You have no access"],400);
                }
            }else{
                
                if ($role->hasAccess([$prefix.'.deleteall']))
                {
                    return $next($request);
                }
                else{
                    return response()->json(['error'=>"You have no access"],400);
                }
            }
        }
    }
}
