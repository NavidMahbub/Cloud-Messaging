<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Recruiting\Visa;
use App\Models\MoneyOut\Expense;
use App\Models\MoneyIn\Income;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use App\User;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\User as UserResource;
use Carbon\Carbon;
use App\Models\Journal\JournalEntry;
use App\Http\Resources\UserChange as UserResourceChange;
class StatisticsController extends Controller
{
    public function index(){
    	$clients = User::where('type',1)->get();
        $total_invoice = Invoice::sum('total');
    	$data = [
    	    'clients' => UserResource::collection($clients),
        ];
        return Response::Json($data); 
    }
    public function report(){
        
        $date = Carbon::today();
        $today_date =   $date.' 22:00:40';
        $today_total_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('journal_entries.created_at', $today_date)->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->sum('journal_entries.amount');
        $today_total_receive = JournalEntry::where('jurnal_type','payment_receive')->where('created_at', $today_date)->sum('amount');
        $today_due_amount = $today_total_invoice-$today_total_receive;
        $today_total_expense = JournalEntry::where('jurnal_type','expense')->where('created_at', $today_date)->sum('amount');
        $today_total_visa = Visa::where('status',1)->where('created_at', $today_date)->count();
        $today_clients = User::where('type',1)->where('created_at', $today_date)->count();
        $today_cash_in_hand = $today_total_receive-$today_total_expense;
        
        $total_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->sum('journal_entries.amount');
        $total_receive = JournalEntry::where('jurnal_type','payment_receive')->sum('amount');
        $due_amount = $total_invoice-$total_receive;
        $total_expense = JournalEntry::where('jurnal_type','expense')->sum('amount');
        $total_visa = Visa::where('status',1)->count();
        $clients = User::where('type',1)->count();
        $cash_in_hand = $total_receive-$total_expense;
        

        $rbl_p_okalawaiting_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')   ->where('visas.status',1)
        ->where('visas.type',1)->where('visas.okala_date',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('completed_date',null)
         ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
         ->sum('journal_entries.amount');

       $rbl_p_okala_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
         ->where('visas.status',1)
         ->where('visas.type',1)->where('visas.okala_date','!=',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
         ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
         ->sum('journal_entries.amount');

       $rbl_p_visa_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
        ->where('visas.status',1)
        ->where('visas.type',1)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
        ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
        ->sum('journal_entries.amount');

       $rbl_p_manpower_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
         ->where('visas.status',1)
         ->where('visas.type',1)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date',null)->where('visas.completed_date',null)
         ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
         ->sum('journal_entries.amount');

       $rbl_p_delivery_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
        ->where('visas.status',1)
        ->where('visas.type',1)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date',null)
        ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
        ->sum('journal_entries.amount');

       $rbl_p_completed_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
        ->where('visas.status',1)
        ->where('visas.type',1)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date','!=',null)
        ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
        ->sum('journal_entries.amount');
        
       $rbl_r_okalawaiting_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')    ->where('visas.status',1)
       ->where('visas.type',2)->where('visas.okala_date',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null) ->where('completed_date',null)
        ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
        ->sum('journal_entries.amount');

      $rbl_r_okala_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
        ->where('visas.status',1)
        ->where('visas.type',2)->where('visas.okala_date','!=',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
        ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
        ->sum('journal_entries.amount');

      $rbl_r_visa_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',2)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

      $rbl_r_manpower_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',2)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date',null)->where('visas.completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

      $rbl_r_delivery_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',2)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

      $rbl_r_completed_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',2)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date','!=',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');
       
       $amir_p_okalawaiting_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')   ->where('visas.status',1)
       ->where('visas.type',3)->where('visas.okala_date',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

     $amir_p_okala_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',3)->where('visas.okala_date','!=',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

     $amir_p_visa_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
      ->where('visas.status',1)
      ->where('visas.type',3)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
      ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
      ->sum('journal_entries.amount');

     $amir_p_manpower_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
       ->where('visas.status',1)
       ->where('visas.type',3)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date',null)->where('visas.completed_date',null)
       ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
       ->sum('journal_entries.amount');

     $amir_p_delivery_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
      ->where('visas.status',1)
      ->where('visas.type',3)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date',null)
      ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
      ->sum('journal_entries.amount');

     $amir_p_completed_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
      ->where('visas.status',1)
      ->where('visas.type',3)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date','!=',null)
      ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
      ->sum('journal_entries.amount');
      
     $amir_r_okalawaiting_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')    ->where('visas.status',1)
      ->where('visas.status',4)->where('visas.type',1)->where('visas.okala_date',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null) ->where('completed_date',null)
      ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
      ->sum('journal_entries.amount');

    $amir_r_okala_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
      ->where('visas.status',1)
      ->where('visas.type',4)->where('visas.okala_date','!=',null)->where('visas.stamping_date',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
      ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
      ->sum('journal_entries.amount');

    $amir_r_visa_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
     ->where('visas.status',1)
     ->where('visas.type',4)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date',null)->where('visas.account_date',null)->where('visas.completed_date',null)
     ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
     ->sum('journal_entries.amount');

    $amir_r_manpower_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
     ->where('visas.status',1)
     ->where('visas.type',4)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date',null)->where('visas.completed_date',null)
     ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
     ->sum('journal_entries.amount');

    $amir_r_delivery_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
     ->where('visas.status',1)
     ->where('visas.type',4)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date',null)
     ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
     ->sum('journal_entries.amount');

    $amir_r_completed_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
     ->where('visas.status',1)
     ->where('visas.type',4)->where('visas.okala_date','!=',null)->where('visas.stamping_date','!=',null)->where('visas.manpowe_date','!=',null)->where('visas.account_date','!=',null)->where('visas.completed_date','!=',null)
     ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')
     ->sum('journal_entries.amount');   
   
     $rbl_p_okalawaiting = Visa::where('status',1)->where('type',1)->where('okala_date',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_p_okala = Visa::where('status',1)->where('type',1)->where('okala_date','!=',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_p_visa = Visa::where('status',1)->where('type',1)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_p_manpower = Visa::where('status',1)->where('type',1)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_p_delivery = Visa::where('status',1)->where('type',1)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date',null)->count();
     $rbl_p_completed = Visa::where('status',1)->where('type',1)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date','!=',null)->count();
     
     $rbl_r_okalawaiting = Visa::where('status',1)->where('type',2)->where('okala_date',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_r_okala = Visa::where('status',1)->where('type',2)->where('okala_date','!=',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_r_visa = Visa::where('status',1)->where('type',2)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_r_manpower = Visa::where('status',1)->where('type',2)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date',null)->where('completed_date',null)->count();
     $rbl_r_delivery = Visa::where('status',1)->where('type',2)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date',null)->count();
     $rbl_r_completed = Visa::where('status',1)->where('type',2)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date','!=',null)->count();
     
     $amir_p_okalawaiting = Visa::where('status',1)->where('type',3)->where('okala_date',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_p_okala = Visa::where('status',1)->where('type',3)->where('okala_date','!=',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_p_visa = Visa::where('status',1)->where('type',3)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_p_manpower = Visa::where('status',1)->where('type',3)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_p_delivery = Visa::where('status',1)->where('type',3)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date',null)->count();
     $amir_p_completed = Visa::where('status',1)->where('type',3)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date','!=',null)->count();
     
     $amir_r_okalawaiting = Visa::where('status',1)->where('type',4)->where('okala_date',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_r_okala = Visa::where('status',1)->where('type',4)->where('okala_date','!=',null)->where('stamping_date',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_r_visa = Visa::where('status',1)->where('type',4)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_r_manpower = Visa::where('status',1)->where('type',4)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date',null)->where('completed_date',null)->count();
     $amir_r_delivery = Visa::where('status',1)->where('type',4)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date',null)->count();
     $amir_r_completed = Visa::where('status',1)->where('type',4)->where('okala_date','!=',null)->where('stamping_date','!=',null)->where('manpowe_date','!=',null)->where('account_date','!=',null)->where('completed_date','!=',null)->count();
       
        $data = [
    	    'today_clients' => $today_clients,
    	    'today_total_invoice' => $today_total_invoice,
    	    'today_total_invoice_due' => $today_due_amount,
    	    'today_total_visa' => $today_total_visa,
    	    'today_total_expense'=>$today_total_expense,
    	    'today_total_payment_receive' =>$today_total_receive,
    	    'today_cash_in_hand'  => $today_cash_in_hand,
    	    'cash_in_hand'   => $cash_in_hand,
    	    'clients' => $clients,
    	    'total_invoice' => $total_invoice,
    	    'total_invoice_due' => $due_amount,
    	    'total_visa' => $total_visa,
    	    'total_expense'=>$total_expense,
            'total_payment_receive' =>$total_receive,

            'rbl_p_okalawaiting_invoice'=>$rbl_p_okalawaiting_invoice,
            'rbl_p_okala_invoice' =>$rbl_p_okala_invoice,
            'rbl_p_visa_invoice' =>$rbl_p_visa_invoice,
            'rbl_p_manpower_invoice' =>$rbl_p_manpower_invoice,
            'rbl_p_delivery_invoice' =>$rbl_p_delivery_invoice,
            'rbl_p_completed_invoice' =>$rbl_p_completed_invoice,
            'rbl_r_okalawaiting_invoice'=>$rbl_r_okalawaiting_invoice,
            'rbl_r_okala_invoice' =>$rbl_r_okala_invoice,
            'rbl_r_visa_invoice' =>$rbl_r_visa_invoice,
            'rbl_r_manpower_invoice' =>$rbl_r_manpower_invoice,
            'rbl_r_delivery_invoice' =>$rbl_r_delivery_invoice,
            'rbl_r_completed_invoice' =>$rbl_r_completed_invoice,
            'amir_p_okalawaiting_invoice'=>$amir_p_okalawaiting_invoice,
            'amir_p_okala_invoice' =>$amir_p_okala_invoice,
            'amir_p_visa_invoice' =>$amir_p_visa_invoice,
            'amir_p_manpower_invoice' =>$amir_p_manpower_invoice,
            'amir_p_delivery_invoice' =>$amir_p_delivery_invoice,
            'amir_p_completed_invoice' =>$amir_p_completed_invoice,
            'amir_r_okalawaiting_invoice'=>$amir_r_okalawaiting_invoice,
            'amir_r_okala_invoice' =>$amir_r_okala_invoice,
            'amir_r_visa_invoice' =>$amir_r_visa_invoice,
            'amir_r_manpower_invoice' =>$amir_r_manpower_invoice,
            'amir_r_delivery_invoice' =>$amir_r_delivery_invoice,
            'amir_r_completed_invoice' =>$amir_r_completed_invoice,
            

            'rbl_p_okalawaiting'=>$rbl_p_okalawaiting,
            'rbl_p_okala' =>$rbl_p_okala,
            'rbl_p_visa' =>$rbl_p_visa,
            'rbl_p_manpower' =>$rbl_p_manpower,
            'rbl_p_delivery' =>$rbl_p_delivery,
            'rbl_p_completed' =>$rbl_p_completed,
            'rbl_r_okalawaiting'=>$rbl_r_okalawaiting,
            'rbl_r_okala' =>$rbl_r_okala,
            'rbl_r_visa' =>$rbl_r_visa,
            'rbl_r_manpower' =>$rbl_r_manpower,
            'rbl_r_delivery' =>$rbl_r_delivery,
            'rbl_r_completed' =>$rbl_r_completed,
            'amir_p_okalawaiting'=>$amir_p_okalawaiting,
            'amir_p_okala' =>$amir_p_okala,
            'amir_p_visa' =>$amir_p_visa,
            'amir_p_manpower' =>$amir_p_manpower,
            'amir_p_delivery' =>$amir_p_delivery,
            'amir_p_completed' =>$amir_p_completed,
            'amir_r_okalawaiting'=>$amir_r_okalawaiting,
            'amir_r_okala' =>$amir_r_okala,
            'amir_r_visa' =>$amir_r_visa,
            'amir_r_manpower' =>$amir_r_manpower,
            'amir_r_delivery' =>$amir_r_delivery,
            'amir_r_completed' =>$amir_r_completed,
        ];
        return Response::Json($data);
    }
}
