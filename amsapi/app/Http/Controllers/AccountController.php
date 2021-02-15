<?php

namespace App\Http\Controllers;

use App\Models\Account\Account;
use Illuminate\Http\Request;

use App\Models\Account\AccountType;

use App\Models\Account\ParentAccount;
use App\Http\Resources\Account as AccountResource;

use DB;

class AccountController extends Controller
{
    public function parentAccount()
    {
        $parent_account = ParentAccount::all();
        return AccountResource::collection($parent_account);
    }

    public function accountType($parent_account_id)
    {
        // return "ok";
        $account_type = DB::table('account_types')->where('parent_account_id',$parent_account_id)->get();
        return  new AccountResource($account_type);
    }
}
