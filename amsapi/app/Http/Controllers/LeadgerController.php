<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MoneyIn\Income;
use App\Http\Resources\Recruiting\Visa as VisaResource;
use App\Http\Resources\Recruiting\VisaBasic as VisaBasicResource;
use App\Http\Resources\GeneralLeadger as GeneralLeadgerResource;
use App\Http\Resources\WorkerReports as WorkerReportsResource;
use App\Http\Resources\CompanyReport as CompanyReportResource;
use DB;
use Carbon\Carbon;
use App\Models\Journal\JournalEntry;
use Auth;
use App\Contact;
use App\Models\Recruiting\Visa;
use App\User;
class LeadgerController extends Controller
{

    public function index(Request $request){
        $vendor_id     = ($request->has('vendor_id'))?$request['vendor_id']:null;
        $account_id     = ($request->has('account_id'))?$request['account_id']:null;
        $visa_id     = ($request->has('visa_id'))?$request['visa_id']:null;
        $contact_id     = ($request->has('customer_id'))?$request['customer_id']:null;
        $cstart_date = ($request->has('start_date'))?$request['start_date']:null;
        $cend_date     = ($request->has('end_date'))?$request['end_date']:null;
        $type     = ($request->has('type'))?$request['type']:null;
        if($cstart_date == null && $cend_date == null)
        {
            $datearray = null;
            // $start_date = date('Y-m-d' . ' 00:00:00', time()); 
            // $end_date = date('Y-m-d' . ' 22:00:40', time());
        }elseif($cstart_date != null && $cend_date == null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cstart_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }elseif($cstart_date != null && $cend_date != null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }elseif($cstart_date == null && $cend_date != null){
            $start_date = $cend_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }else{
            $datearray = null;
        }
        
        // $queary  = JournalEntry::when($datearray, function($q) use($datearray){return $q->whereBetween('journal_entries.created_at',$datearray);})
        //         ->get();
                if($type==1){
                    $queary  = JournalEntry::leftJoin('visas','journal_entries.visa_id','=','visas.id')->where(function($q) use($visa_id) {
                        $q->where(function($q) use($visa_id){
                            $q->whereNull('journal_entries.visa_id');
                        })->orWhere(function($q) use($visa_id){
                            $q->whereNotNull('visas.okala_date') 
                            ->when($visa_id, function($q) use($visa_id){return $q->where('journal_entries.visa_id', $visa_id);})->where('visas.status',1);
                        });
                    })
                    ->select('journal_entries.*')
                    ->whereIn('journal_entries.jurnal_type',['payment_receive','expense','payment_made'])
                    ->when($contact_id, function($q) use($contact_id){return $q->where('journal_entries.contact_id',$contact_id);})
                    ->when($account_id, function($q) use($account_id){return $q->where('journal_entries.account_id',$account_id);})
                    ->when($datearray, function($q) use($datearray){return $q->whereBetween('journal_entries.created_at', $datearray);})
                    ->orderBy('journal_entries.created_at', 'desc')
                    ->get();
                }
                if($type==2){
                    $queary  = JournalEntry::leftJoin('visas','journal_entries.visa_id','=','visas.id')->where(function($q) use($visa_id) {
                        $q->where(function($q) use($visa_id){
                            $q->whereNull('journal_entries.visa_id');
                        })->orWhere(function($q) use($visa_id){
                            $q->whereNotNull('visas.okala_date') 
                            ->when($visa_id, function($q) use($visa_id){return $q->where('journal_entries.visa_id', $visa_id);})->where('visas.status',1);
                        });
                    })
                    ->select('journal_entries.*')
                    ->whereIn('journal_entries.jurnal_type',['payment_receive','invoice','bill','payment_made'])
                    ->when($contact_id, function($q) use($contact_id){return $q->where('journal_entries.contact_id',$contact_id);})
                    ->when($account_id, function($q) use($account_id){return $q->where('journal_entries.account_id',$account_id);})
                    ->when($datearray, function($q) use($datearray){return $q->whereBetween('journal_entries.created_at', $datearray);})
                    ->orderBy('journal_entries.created_at', 'desc')
                    ->get();
                }
                
        return GeneralLeadgerResource::collection($queary);
    }
    public function currentLeadger(){
    	$filterIncomeExpense = '';
    	$current_month = date('m');

    	$incomes = DB::select( DB::raw("SELECT *, ifnull(amount, 0) + ifnull(utility, 0)+ ifnull(car_parking, 0)+ ifnull(registration_cost, 0)+ ifnull(other_cost, 0) - ifnull(gift, 0) - ifnull(discount, 0)  as total, 1 as type  FROM incomes WHERE MONTH(date) = '$current_month' ") );
    	$expenses = DB::select( DB::raw("SELECT *,ifnull(amount, 0) + ifnull(tax_total, 0) as total, 2 as type FROM expenses WHERE MONTH(date) = '$current_month' ") );

    	 $filterIncomeExpense = array_merge($expenses,$incomes);
    	$newFilterIncomeExpense = [];
    	foreach ($filterIncomeExpense as $key => $value) {

    		if( isset($value->customer_id) ? $value->customer_id : false){
    			$customer = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->customer_id' "));
    		}
    		else{
    			$customer = '';
    		}
    		if( isset($value->vendor_id) ? $value->vendor_id : false){
    			$vendor = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->vendor_id' "));
    		}
    		else{
    			$vendor = '';
    		}

    		$account = DB::select( DB::raw("SELECT name FROM accounts WHERE id = '$value->account_id' "));
    		$data = $arrayName = array('date' => $value->date,'total' => $value->total,'type'=>$value->type,'customer'=> $customer,'vendor'=> $vendor,'account'=>$account);
    		array_push($newFilterIncomeExpense,$data);
    	}

    	return $newFilterIncomeExpense;

    }

    public function searchLeadger(Request $request){
        //return $request->all();
    	$filterIncomeExpense = '';

    	$vendor_id = $request->vandor_id;
    	$account_id = $request->account_id;
    	$customer_id = $request->customer_id;
    	$strat_date = $request->strat_date;
    	$end_date = $request->end_date;
    	if($strat_date != '' && $end_date == '')
    	{
    		return '';
    	}


    	$incomes = DB::select( DB::raw("SELECT *, ifnull(amount, 0) + ifnull(utility, 0)+ ifnull(car_parking, 0)+ ifnull(registration_cost, 0)+ ifnull(other_cost, 0) - ifnull(gift, 0) - ifnull(discount, 0)  as total, 1 as type  FROM incomes WHERE date between '$strat_date' and '$end_date' or account_id = '$account_id' or customer_id = '$customer_id'") );
    	$expenses = DB::select( DB::raw("SELECT *,ifnull(amount, 0) + ifnull(tax_total, 0) as total, 2 as type FROM expenses WHERE date between '$strat_date' and '$end_date' or account_id = '$account_id' or vendor_id = '$vendor_id'") );

    	// return $results = DB::select( DB::raw("SELECT * FROM incomes WHERE date between '2012-03-11' and '2019-05-11' ") );

    	$filterIncomeExpense = array_merge($expenses,$incomes);
    	$newFilterIncomeExpense = [];
    	foreach ($filterIncomeExpense as $key => $value) {

    		if( isset($value->customer_id) ? $value->customer_id : false){
    			$customer = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->customer_id' "));
    		}
    		else{
    			$customer = '';
    		}
    		if( isset($value->vendor_id) ? $value->vendor_id : false){
    			$vendor = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->vendor_id' "));
    		}
    		else{
    			$vendor = '';
    		}

    		$account = DB::select( DB::raw("SELECT name FROM accounts WHERE id = '$value->account_id' "));
    		$data = $arrayName = array('date' => $value->date,'total' => $value->total,'type'=>$value->type,'customer'=> $customer,'vendor'=> $vendor,'account'=>$account);
    		array_push($newFilterIncomeExpense,$data);
    	}

    	return $newFilterIncomeExpense;

    }
    public function dashboardLeadger(Request $request){

        $filterIncomeExpense = '';

        $vendor_id = $request->vandor_id;
        $account_id = $request->account_id;
        $customer_id = $request->customer_id;
        $strat_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');
        if($strat_date != '' && $end_date == '')
        {
            return '';
        }

        $incomes = DB::select( DB::raw("SELECT *, ifnull(amount, 0) + ifnull(utility, 0)+ ifnull(car_parking, 0)+ ifnull(registration_cost, 0)+ ifnull(other_cost, 0) - ifnull(gift, 0) - ifnull(discount, 0)  as total, 1 as type  FROM incomes WHERE date between '$strat_date' and '$end_date' or account_id = '$account_id' or customer_id = '$customer_id'") );
        $expenses = DB::select( DB::raw("SELECT *,ifnull(amount, 0) + ifnull(tax_total, 0) as total, 2 as type FROM expenses WHERE date between '$strat_date' and '$end_date' or account_id = '$account_id' or vendor_id = '$vendor_id'") );

        // return $results = DB::select( DB::raw("SELECT * FROM incomes WHERE date between '2012-03-11' and '2019-05-11' ") );

         $filterIncomeExpense = array_merge($expenses,$incomes);
        $newFilterIncomeExpense = [];
        foreach ($filterIncomeExpense as $key => $value) {

            if( isset($value->customer_id) ? $value->customer_id : false){
                $customer = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->customer_id' "));
            }
            else{
                $customer = '';
            }
            if( isset($value->vendor_id) ? $value->vendor_id : false){
                $vendor = DB::select( DB::raw("SELECT name FROM users WHERE id = '$value->vendor_id' "));
            }
            else{
                $vendor = '';
            }

            $account = DB::select( DB::raw("SELECT name FROM accounts WHERE id = '$value->account_id' "));
            $data = $arrayName = array('date' => $value->date,'total' => $value->total,'type'=>$value->type,'customer'=> $customer,'vendor'=> $vendor,'account'=>$account);
            array_push($newFilterIncomeExpense,$data);
        }

        return $newFilterIncomeExpense;

    }
    
    public function workers(Request $request){
        //$vendor_id     = ($request->has('vendor_id'))?$request['vendor_id']:null;
        //$account_id     = ($request->has('account_id'))?$request['account_id']:null;
        //$visa_id     = ($request->has('visa_id'))?$request['visa_id']:null;
      
      $contact_id     = ($request->has('customer_id'))?$request['customer_id']:null;
        
      $diving_licence_status     = ($request->has('diving_licence_status'))?$request['diving_licence_status']:null;
      $type     = ($request->has('type'))?$request['type']:null;
      $police_clearence_status     = ($request->has('police_clearence_status'))?$request['police_clearence_status']:null;
      $medical_status     = ($request->has('medical_status'))?$request['medical_status']:null;
      $musaned_status     = ($request->has('musaned_status'))?$request['musaned_status']:null;
      $okala_status     = ($request->has('okala_status'))?$request['okala_status']:null;
      $mofa_status     = ($request->has('mofa_status'))?$request['mofa_status']:null;
      $stamping_status     = ($request->has('stamping_status'))?$request['stamping_status']:null;
      $finger_training_status     = ($request->has('finger_training_status'))?$request['finger_training_status']:null;
      $manpower_status     = ($request->has('manpower_status'))?$request['manpower_status']:null;
      $flight_status     = ($request->has('flight_status'))?$request['flight_status']:null;
      $account_status     = ($request->has('account_status'))?$request['account_status']:null;
      $limit     = ($request->has('limit'))?$request['limit']:50;
      $search     = ($request->has('search'))?$request['search']:null;
      $cstart_date = ($request->has('start_date'))?$request['start_date']:null;
      $cend_date     = ($request->has('end_date'))?$request['end_date']:null;
      
        if($cstart_date == null && $cend_date == null)
        {
            $datearray = null;
            // $start_date = date('Y-m-d' . ' 00:00:00', time()); 
            // $end_date = date('Y-m-d' . ' 22:00:40', time());
        }elseif($cstart_date != null && $cend_date == null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cstart_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }elseif($cstart_date != null && $cend_date != null){
            $start_date = $cstart_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }elseif($cstart_date == null && $cend_date != null){
            $start_date = $cend_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }else{
            $datearray = null;
        }
      $client_id     = ($request->has('customer_id'))?$request['customer_id']:null;
      if($client_id!=null || $search!=null){
          $datearray = null; 
      }
      // return $datearray;
      //UserBadge::where('user_id',Auth::user()->id)->groupBy('badge_id')->when($datearray, function($q) use($datearray){return $q->whereBetween('created_at', $datearray);})->select('badge_id',DB::raw('count(*) as level'))->with('badge')->get();
      if($request['type']==1){
        $visa = Visa::where('status',1)
              ->whereNotNull('okala_date')
              ->when($datearray, function($q) use($datearray){return $q->whereBetween('created_at', $datearray);})
              ->when($contact_id, function($q) use($contact_id){return $q->where('contact_id',$contact_id);})
              ->groupBy('user_id')->select('user_id',DB::raw('count(*) as total'))->with('client')->get();
               return WorkerReportsResource::collection($visa);
             
      }elseif($request['type']==2){
        $visa = Visa::where('status',1)
              ->whereNotNull('okala_date')
              ->whereNotNull('company_id')
              ->when($datearray, function($q) use($datearray){return $q->whereBetween('created_at', $datearray);})
              ->when($contact_id, function($q) use($contact_id){return $q->where('contact_id',$contact_id);})
              ->groupBy('company_id')->select('company_id as company_id',DB::raw('count(*) as total'))->with('client')->get();
               return CompanyReportResource::collection($visa);

      }

      
      
    }
}


// select ifnull(item_1, 0) + ifnull(item_2, 0) + ifnull(item_3, 0) + ifnull(item_4, 0) as ItemSum
// from MyTable

