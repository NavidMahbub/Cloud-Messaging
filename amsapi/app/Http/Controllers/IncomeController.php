<?php

namespace App\Http\Controllers;

use App\Models\MoneyIn\Income;
use Illuminate\Http\Request;
use Sentinel;
use App\RoleUser;
use App\Http\Resources\Income as IncomeResource;
use App\Models\Account\Account;
use App\Models\Account\Tax;
use App\Models\Journal\JournalEntry;
use DB;
use Auth;
class IncomeController extends Controller
{
    public function index(Request $request){
        $agent = ($request->has('agent'))?$request['agent']:null;
        $customer = ($request->has('customer'))?$request['customer']:null;
        $purpose = ($request->has('purpose'))?$request['purpose']:null;

        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        $income = '';
        if ($role->hasAccess(['income.view'])){
            $income  = Income::when($agent || $customer || $purpose, function($q) use($agent,$customer,$purpose,$user_id){return $q->when('created_by',$user_id)->where('agent_id',$agent)->orWhere('customer_id',$customer)->orWhere('account_id',$purpose);})
                ->when($user_id , function($q) use($user_id){return $q->where('created_by',$user_id);})
                ->paginate(10);
        }
        if ($role->hasAccess(['income.viewall'])){
            $income  = Income::when($agent || $customer || $purpose, function($q) use($agent,$customer,$purpose){return $q->where('agent_id',$agent)->orWhere('customer_id',$customer)->orWhere('account_id',$purpose);})
                ->paginate(10);
        }

         
        return IncomeResource::collection($income);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        $income = $request->isMethod('put') ? Income::findOrFail($request->income_id) : new Income;
        $income -> date = $request->input('date');
        $income -> amount = $request->input('amount');
        $income -> discount = $request->input('discount');
        //$income -> utility = $request->input('utility');
        //$income -> car_parking = $request->input('car_parking');
        //$income -> registration_cost = $request->input('registration_cost');
        // $income -> tax_total = $request->input('tax_total');
        //$income -> other_cost = $request->input('other_cost');
        //$income -> gift = $request->input('gift');
        //$income -> reference = $request->input('reference');
        $income -> note = $request->input('note');
        $income -> account_id = $request->input('account_id');
        $income -> mode_id = $request->input('mode');
        $income -> agent_id = $request->input('agent_id');
        $income -> customer_id = $request->input('customer_id');
        $income -> bank_info = $request->input('bank_info');

        $log_user = Auth()->user();
        $request->isMethod('put') ?  $income ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $income ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $income ->updated_by = $log_user->id : '' ;

        
        if($income->save()){
            $total_tax = 0;
            $status = $this->insertIncomeInJournal($total_tax, $data['amount'], $data, $income->id);
            if($status)
            {
                DB::commit();
                return new IncomeResource($income);
                
            }
            else
            {

                $income = Income::find($income->id);
                $income->delete();
                {
                    DB::rollBack();
                   return response()->json(['errors' =>['message'=>'Some Wrongh']], 400); 
                }
            }
        }
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);

        if($income->delete()){
            return new IncomeResource($income);
        }
    }

     public function insertIncomeInJournal($total_tax, $total_amount, $data, $income_id)
    {

        
        $income_entries_delete = JournalEntry::where('income_id',$income_id)->get();
       
        if(!empty($income_entries_delete))
        {
            $income_entries_delete->each->delete();
        }

        $user_id = Auth::user()->id;

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = round(($total_tax + $total_amount) , 2);
        $journal_entry->jurnal_type    = "income";
        $journal_entry->account_id = $data['mode'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['note'];
        $journal_entry->income_id       = $income_id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;

        if($journal_entry->save())
        {
            $journal_entry = new JournalEntry;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type    = "income";
            $journal_entry->account_id      = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['note'];
            $journal_entry->income_id       = $income_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;

            if($journal_entry->save())
            {
                return true;
                // $journal_entry = new JournalEntry;
                // $journal_entry->debit_credit    = 0;
                // $journal_entry->amount          = round($total_tax, 2);
                // $journal_entry->jurnal_type    = "income";
                // $journal_entry->account_name_id = 9;
                // $journal_entry->contact_id      = $data['customer_id'];
                // $journal_entry->note            = $data['customer_note'];
                // $journal_entry->income_id       = $income_id;
                // $journal_entry->created_by      = $user_id;
                // $journal_entry->updated_by      = $user_id;

                // if($journal_entry->save())
                // {
                //     return true;
                // }
                // else
                // {
                //     return false;
                // }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function updateIncomeInJournal($total_tax, $total_amount, $data, $income_id)
    {
        $user_id = Auth::user()->id;

        $income_entries_delete = Income::find($income_id)->journalEntries();

        if($income_entries_delete->delete())
        {

        }

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = round(($total_tax + $total_amount), 2);
        $journal_entry->jurnal_type    = "income";
        $journal_entry->account_name_id = $data['receive_through_id'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->income_id       = $income_id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;

        if($journal_entry->save())
        {
            $journal_entry = new JournalEntry;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type    = "income";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->income_id       = $income_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;

            if($journal_entry->save())
            {
                $journal_entry = new JournalEntry;
                $journal_entry->debit_credit    = 0;
                $journal_entry->amount          = round($total_tax, 2);
                $journal_entry->jurnal_type    = "income";
                $journal_entry->account_name_id = 9;
                $journal_entry->contact_id      = $data['customer_id'];
                $journal_entry->note            = $data['customer_note'];
                $journal_entry->income_id       = $income_id;
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;

                if($journal_entry->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}


            
