<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account\Account;
use App\RoleUser;
use Sentinel;

use App\Http\Resources\Purpose as PurposeResource;

class PurposeController extends Controller
{
    public function index(){
    	$purpose = Account::all();
    	return PurposeResource::collection($purpose);
    }

    public function pagination(Request $request){
        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        $search_item = ($request->has('search_item'))?$request['search_item']:null;
        $purpose = '';
        if ($role->hasAccess(['purpose.view'])){
            $purpose  = Account::when($search_item, function($q) use($search_item,$user_id){return $q->where('created_by',$user_id)->where('name','like',"%$search_item%");})
                ->when($user_id , function($q) use($user_id){return $q->where('created_by',$user_id);})
                            ->paginate(10);  
        }
        if ($role->hasAccess(['purpose.viewall'])){
            $purpose  = Account::when($search_item, function($q) use($search_item){return $q->where('name','like',"%$search_item%");})
                        ->paginate(10);  
        }
              
        return PurposeResource::collection($purpose);
    }

    public function store(Request $request)
    {

        $purpose = $request->isMethod('put') ? Account::findOrFail($request->purpose_id) : new Account;
        $purpose -> account_type_id = $request->input('account_type_id');
        $purpose -> name = $request->input('name');
        $purpose -> description = $request->input('description');
        
        $log_user = Auth()->user();
        $request->isMethod('put') ?  $purpose ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $purpose ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $purpose ->updated_by = $log_user->id : '' ;

        if($purpose->save()){
            return new PurposeResource($purpose);
        }
    }

    public function destroy($id)
    {
        $purpose = Account::findOrFail($id);

        if($purpose->delete()){
        	return new PurposeResource($purpose);
        }
    }
}
