<?php

namespace App\Http\Controllers\Recruiting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Recruiting\Visa as VisaResource;
use App\Http\Resources\Recruiting\VisaBasic as VisaBasicResource;
use App\Models\Recruiting\Visa;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyOut\Bill;
use Auth;
use Carbon\Carbon;
use App\Models\Journal\JournalEntry;
use App\Models\MoneyIn\PaymentReceive;
use App\Lib\Helper;
class VisaController extends Controller
{
    public function __construct()
    {
       
    }
    public function index(Request $request){
        
        //return $request->all();
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
        }else{
            $start_date = $cend_date.' 00:00:00';
            $end_date =   $cend_date.' 22:00:40';
            $datearray = array($start_date,$end_date);
        }
       
      $client_id     = ($request->has('customer_id'))?$request['customer_id']:null;
      if($client_id!=null || $search!=null){
          $datearray = null; 
      }
      
      if($search!=null){
          $diving_licence_status     = null;
          $type     = null;
          $police_clearence_status     = null;
          $medical_status     = null;
          $musaned_status     = null;
          $okala_status     = null;
          $mofa_status     = null;
          $stamping_status     = null;
          $finger_training_status     = null;
          $manpower_status     = null;
          $flight_status     = null;
          $account_status     = null;
          $cstart_date = null;
          $cend_date     = null;
          $datearray = null;
      }
      
      //return $datearray;
      $visa = Visa::when($diving_licence_status, function($q) use($diving_licence_status){return $q->where('diving_licence_status', $diving_licence_status);})
          ->when($police_clearence_status, function($q) use($police_clearence_status){return $q->where('police_clearence_status', $police_clearence_status);})
          ->when($medical_status, function($q) use($medical_status){return $q->where('medical_status', $medical_status);})
          ->when($musaned_status, function($q) use($musaned_status){return $q->where('musaned_status', $musaned_status);})
          ->when($okala_status, function($q) use($okala_status){return $q->where('okala_status', $okala_status);})
          ->when($mofa_status, function($q) use($mofa_status){return $q->where('mofa_status', $mofa_status);})
          ->when($stamping_status, function($q) use($stamping_status){return $q->where('stamping_status', $stamping_status);})
          ->when($finger_training_status, function($q) use($finger_training_status){return $q->where('finger_training_status', $finger_training_status);})
          ->when($manpower_status, function($q) use($manpower_status){return $q->where('manpower_status', $manpower_status);})
          ->when($flight_status, function($q) use($flight_status){return $q->where('flight_status', $flight_status);})
          ->when($account_status, function($q) use($account_status){return $q->where('account_status', $account_status);})
          ->when($type, function($q) use($type){return $q->where('type', $type);})
          ->when($client_id, function($q) use($client_id){return $q->where('user_id',$client_id);})
          ->when($search, function($q) use($search){return $q->where('passport_number','like',"%$search%")->OrWhere('visa_number','like',"%$search%")->OrWhere('worker_number','like',"%$search%");})
          ->when($datearray, function($q) use($datearray){return $q->whereBetween('created_at', $datearray);})
           ->orderBy('id', 'desc')->paginate($limit);
        return VisaBasicResource::collection($visa);
    }

    public function store(Request $request){
        $Helper = new Helper;
         //return $request->all();
        if($request->input('id')!=null){
            $validatedData = $request->validate([
                'visa_number'          => 'required',
                'user_id'              =>'required',
                //'agent_id'           =>'required',
                'passport_number'      => 'required|unique:visas,passport_number,'.$request->input('id'),
                'passport_name'        => 'required',
                'type'                 => 'required',
                'processing_rate'      => 'required|numeric',
                'occupation'           =>'required',
            ]);
        }else{
            $validatedData = $request->validate([
                'visa_number'          => 'required',
                'user_id'              =>'required',
                //'agent_id'           =>'required',
                'passport_number'      => 'required|unique:visas,passport_number',
                'passport_name'        => 'required',
                'type'                 => 'required',
                'processing_rate'      => 'required|numeric',
                'occupation'           =>'required',
            ]);
        }
        
        //$user = Auth::user();
        $user_id = Auth()->user()->id;
        if($request->input('id')==null){
             $lastid = Visa::orderBy('id','DESC')->where('type',$request->input('type'))->first();
            if($lastid){
              if($request->input('type')==1 || $request->input('type')==2){
                $worker_number = $request->input('worker_number').(substr($lastid->worker_number,5)+1);
              }elseif($request->input('type')==3 || $request->input('type')==4){
                $worker_number = $request->input('worker_number').(substr($lastid->worker_number,6)+1);
              }else{
                $worker_number = $request->input('worker_number').(substr($lastid->worker_number,5)+1);
              }
            }else{
               $worker_number = $request->input('worker_number').'1';
            }
        }else{
            $worker_number = $request->input('worker_number');
        }
        
        $visa = $request->input('id')!=null ? Visa::findOrfail($request->id) : new Visa();
        $old_visa = $request->input('id')!=null ? Visa::findOrfail($request->id) : new Visa();
        if($request->input('id')!==null){
            $old_user_id = $visa->user_id;
            $old_company_id = $visa->company_id;
        }
        $visa->passport_name = $request->input('passport_name');
        $visa->passport_number = $request->input('passport_number');
        $visa->visa_number = $request->input('visa_number');
        $visa->processing_rate = $request->input('processing_rate');
        $visa->company_rate = $request->input('company_rate');
        $visa->company_id_number = $request->input('company_id_number');
        $visa->occupation = $request->input('occupation');
        $visa->gender = $request->input('gender');
        $visa->remarks = $request->input('remarks');
        $visa->status = $request->input('status');
        
        $visa->diving_licence_by = $user_id;
        $visa->diving_licence_status = $request->input('diving_licence_status');
       
        $visa->police_clearence_by = $user_id;
        $visa->police_clearence_status = $request->input('police_clearence_status');
       
        $visa->medical_by = $user_id;
          if($request->input('medical_status')==true ||  $request->input('medical_status')==1){
               $visa->medical_status = 1;
          }else{
              $visa->medical_status = null;
          }
         
        $visa->medical = $request->input('medical');
        $visa->musaned_date_by = $user_id;
          
          if($request->input('musaned_status')==true ||  $request->input('musaned_status')==1){
               $visa->musaned_status = 1;
          }else{
              $visa->musaned_status = null;
          }
        $visa->musaned_date = $request->input('musaned_date');
        $visa->okala_date_by = $user_id;
          if($request->input('okala_status')==true ||  $request->input('okala_status')==1){
               $visa->okala_status = 1;
          }else{
              $visa->okala_status = null;
          }
        $visa->okala_date = $request->input('okala_date');
        $visa->mofa_date_by = $user_id;
          
          if($request->input('mofa_status')==true ||  $request->input('mofa_status')==1){
               $visa->mofa_status = 1;
          }else{
              $visa->mofa_status = null;
          }
          
        $visa->mofa_date = $request->input('mofa_date');
        $visa->stamping_by = $user_id;
          if($request->input('stamping_status')==true ||  $request->input('stamping_status')==1){
               $visa->stamping_status = 1;
          }else{
              $visa->stamping_status = null;
          }
        $visa->stamping_date = $request->input('stamping_date');
        $visa->finger_training_by = $user_id;
          if($request->input('finger_training_status')==true ||  $request->input('finger_training_status')==1){
               $visa->finger_training_status = 1;
          }else{
              $visa->finger_training_status = null;
          }
        $visa->finger_training_date = $request->input('finger_training_date');
        $visa->training_by = $user_id;
        $visa->training = $request->input('training');
        $visa->training_date = $request->input('training_date');
        $visa->manpowe_date_by = $user_id;
          if($request->input('manpower_status')==true ||  $request->input('manpower_status')==1){
               $visa->manpower_status = 1;
          }else{
              $visa->manpower_status = null;
          }
        $visa->manpowe_date = $request->input('manpowe_date');
        $visa->flight_date_by = $user_id;
          if($request->input('flight_status')==true ||  $request->input('flight_status')==1){
               $visa->flight_status = 1;
          }else{
              $visa->flight_status = null;
          }
        $visa->flight_date = $request->input('flight_date');
        $visa->completed_by = $user_id;
        $visa->completed = $request->input('completed');
        $visa->completed_date = $request->input('completed_date');
        $visa->account_date_by = $user_id;
        $visa->account_status = $request->input('account_status');
        $visa->account_date = $request->input('account_date');
        
        
       
        $visa->agent_id = $request->input('agent_id');
        $visa->user_id = $request->input('user_id');
        $visa->company_id = $request->input('company_id');
        if($request->input('id')==null){
          $visa->created_by = $user_id;
          $visa->status = 1;
          $visa->worker_number = $worker_number;
        }
        $visa->updated_by = $user_id;
        $visa->type = $request->input('type');
        $visa->save();
        if($request->input('id')!==null){
            if($visa->user_id!=$old_user_id){
                $this->updateUserWorkersRelated($visa->id,$visa->user_id,$old_user_id);
            }
            if($visa->company_id!=$old_company_id){
                $this->updateCompanyWorkersRelated($visa->id,$visa->company_id,$old_company_id);
            }
        }
        if($request->input('type')==5){
            if($request->input('id')==null){
                if($visa->flight_date!=null){
                    $bill = $Helper->Bill($visa->created_at,$visa->user_id,$visa->id,$visa->company_rate,$visa->company_rate,$visa->company_id);
                    $Helper->ManualJournalEntries($bill->id,$bill->visa_id,1,$bill->amount,$bill->vendor_id,$bill->note,'bill');
                }
                if($visa->stamping_date!=null){
                    $invoice  = $Helper->Invoice($visa->created_at,$visa->company_id,$visa->id,$visa->agent_id,1,$visa->processing_rate,$visa->processing_rate);
                    $Helper->ManualJournalEntries($invoice->id,$invoice->visa_id,1,$invoice->total,$invoice->customer_id,$invoice->personal_note,'invoice');
                }
            }else{
                //return $old_visa->flight_date;
                if($old_visa->flight_date==null && $visa->flight_date !=null)
                {
                    //return "a";
                    $bill = $Helper->Bill($visa->created_at,$visa->user_id,$visa->id,$visa->company_rate,$visa->company_rate,$visa->company_id);
                    $Helper->ManualJournalEntries($bill->id,$bill->visa_id,1,$bill->amount,$bill->vendor_id,$bill->note,'bill');
                }
                if($old_visa->flight_date==null && $visa->flight_date==null)
                {
                    $this->deleteWorkersRelated($visa,2,'bill');

                }
                if($old_visa->flight_date!=null && $visa->flight_date==null)
                {
                    $this->deleteWorkersRelated($visa,2,'bill');

                }

                if($old_visa->stamping_date==null && $visa->stamping_date !=null)
                {
                    $invoice  = $Helper->Invoice($visa->created_at,$visa->company_id,$visa->id,$visa->agent_id,1,$visa->processing_rate,$visa->processing_rate);
                    $Helper->ManualJournalEntries($invoice->id,$invoice->visa_id,1,$invoice->total,$invoice->customer_id,$invoice->personal_note,'invoice');
                }
                if($old_visa->stamping_date==null && $visa->stamping_date==null)
                {
                    $this->deleteWorkersRelated($visa,1,'invoice');

                }
                if($old_visa->stamping_date!=null && $visa->stamping_date==null)
                {
                    $this->deleteWorkersRelated($visa,1,'invoice');

                }
            }
        }else{
            
            if($request->input('id')==null){
                if($visa->okala_date!=null){
                    $invoice  = $Helper->Invoice($visa->created_at,$visa->user_id,$visa->id,$visa->agent_id,1,$visa->processing_rate,$visa->processing_rate);
                    $Helper->ManualJournalEntries($invoice->id,$invoice->visa_id,1,$invoice->total,$invoice->customer_id,$invoice->personal_note,'invoice');
                }
            }else{
                
                if($old_visa->okala_date==null && $visa->okala_date !=null)
                {
                    
                    $invoice  = $Helper->Invoice($visa->created_at,$visa->user_id,$visa->id,$visa->agent_id,1,$visa->processing_rate,$visa->processing_rate);
                    $Helper->ManualJournalEntries($invoice->id,$invoice->visa_id,1,$invoice->total,$invoice->customer_id,$invoice->personal_note,'invoice');
                }
                if($old_visa->okala_date==null && $visa->okala_date==null)
                {
                    $this->deleteWorkersRelated($visa,1,'all');

                }
                if($old_visa->okala_date!=null && $visa->okala_date==null)
                {
                    $this->deleteWorkersRelated($visa,1,'all');

                }
            }
            
        }  
        return new VisaResource($visa);

    }
    
    public function  show($id){
        $visa = Visa::find($id);
        return new VisaResource($visa);  
    }
    
    public function updateUserWorkersRelated($visa,$new_user,$old_user){
        $auth_user = Auth::user()->id;
        $invoiceA = Invoice::where('visa_id',$visa)->where('customer_id',$old_user)->pluck('id');
        Invoice::whereIn('id',$invoiceA)->update(array('customer_id' => $new_user,'updated_by'=>$auth_user));
        $JournalEntryA = JournalEntry::Where('visa_id',$visa)->where('jurnal_type','invoice')->where('contact_id',$old_user)->pluck('id');
        JournalEntry::whereIn('id',$JournalEntryA)->update(array('contact_id'=>$new_user,'updated_by'=>$auth_user));
        $billA = Bill::where('visa_id',$visa)->where('vendor_id',$old_user)->pluck('id');
        Bill::whereIn('id',$billA)->update(array('vendor_id'=>$new_user,'updated_by'=>$auth_user));
    }
    public function updateCompanyWorkersRelated($visa,$new_company,$old_company){
        $auth_user = Auth::user()->id;
        $invoiceA = Invoice::where('visa_id',$visa)->where('customer_id',$old_company)->pluck('id');
        Invoice::whereIn('id',$invoiceA)->update(array('customer_id' => $new_company,'updated_by'=>$auth_user));
        $JournalEntryA = JournalEntry::Where('visa_id',$visa->id)->where('jurnal_type','invoice')->where('contact_id',$old_company)->pluck('id');
        JournalEntry::whereIn('id',$JournalEntryA)->update(array('contact_id'=>$new_company,'updated_by'=>$auth_user));
    }
    public function deleteWorkersRelated($visa,$type,$deletetype){
        if($type==1){
          $customer_id =   $visa->user_id;
        }else{
          $customer_id =   $visa->company_id;
        }
        if($deletetype=='all'){
            $invoiceA = Invoice::where('visa_id',$visa->id)->where('customer_id',$customer_id)->pluck('id');
            $JournalEntryIn = JournalEntry::whereIn('invoice_id',$invoiceA)->get();
            $JournalEntryIn->each->delete();
            $invoice = Invoice::where('visa_id',$visa->id)->where('customer_id',$customer_id)->get();
            $invoice->each->delete();

            $billA = Bill::where('visa_id',$visa->id)->where('company_id',$customer_id)->pluck('id');
            $bill = Bill::where('visa_id',$visa->id)->where('company_id',$customer_id)->get();
            $JournalEntryBill = JournalEntry::whereIn('bill_id',$billA)->get();
            $JournalEntryBill->each->delete();
            $bill->each->delete();
        }
        if($deletetype=='bill'){
            $billA = Bill::where('visa_id',$visa->id)->where('company_id',$customer_id)->pluck('id');
            $bill = Bill::where('visa_id',$visa->id)->where('company_id',$customer_id)->get();
            $JournalEntryBill = JournalEntry::whereIn('bill_id',$billA)->get();
            $JournalEntryBill->each->delete();
            $bill->each->delete();
        }
        if($deletetype=='invoice'){
            $invoiceA = Invoice::where('visa_id',$visa->id)->where('customer_id',$customer_id)->pluck('id');
            $JournalEntryIn = JournalEntry::whereIn('invoice_id',$invoiceA)->get();
            $JournalEntryIn->each->delete();
            $invoice = Invoice::where('visa_id',$visa->id)->where('customer_id',$customer_id)->get();
            $invoice->each->delete();
        }
        
        return true;
    }

    public function  delete($id){
        $visa = Visa::find($id);
        $invoiceA = Invoice::where('visa_id',$visa->id)->pluck('id');
        $JournalEntry = JournalEntry::Where('visa_id',$visa->id)->get();
        $PaymentReceive = PaymentReceive::Join('payment_receive_entries','payment_receive_entries.payment_receive_id','=','payment_receives.id')
           ->select('payment_receives.*')->WhereIn('payment_receive_entries.invoice_id',$invoiceA)->get();
        $JournalEntry->each->delete();
        $PaymentReceive->each->delete();
        $invoice = Invoice::where('visa_id',$visa->id)->get();
        $invoice->each->delete();
        $bill = Bill::where('visa_id',$id)->get();
        $bill->each->delete();
        if($visa){
            if($visa->delete()){
                return new VisaResource($visa); 
            }
        }
    }
    
    public function  getlastid($type){
         $lastid = Visa::orderBy('id','DESC')->where('type',$type)->first();
        if($lastid){
          if($type==1 || $type==2){
            $id = substr($lastid->worker_number,5);
          }elseif($type==3 || $type==4){
            $id = substr($lastid->worker_number,6);
          }else{
            $id = substr($lastid->worker_number,5);
          }
          
            return $id+1;
        }else{
           return 1; 
        }
    }
    
    public function customerVisa($id){
        $visa = Visa::where('user_id',$id)->orwhere('company_id',$id)->get();
        return VisaResource::collection($visa);
    }
    
     public function  igetlastid(){
        $lastid = Invoice::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
    public function  pgetlastid(){
        $lastid = PaymentReceive::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }
    public function  bgetlastid(){
        $lastid = Bill::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }

    public function insertManualJournalEntries($visa,$invoice,$agent_commission_amount)
    {
        $user_id = Auth::user()->id;
        $invoice_entries_delete = JournalEntry::where('invoice_id',$invoice->id)->get();
       
        if(!empty($invoice_entries_delete))
        {
            $invoice_entries_delete->each->delete();
        }
        // $i = 0;
        // $discount = 0;
        // $account_array = array_fill(1, 100, 0);
        // foreach ($data['item_id'] as $account)
        // {
        //     if($data['discount'][$i] == "")
        //     {

        //     }
        //     else
        //     {
        //         $amount = $data['quantity'][$i]*$data['rate'][$i];
        //         $discount = $discount + ($data['discount'][$i]*$amount)/100;
        //         //$discount1 = ($data['discount'][$i]*$amount)/100;
        //     }

        //     $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i]);

        //     $i++;
        // }



        //return $account_array;

        //for agent commission manual journal entry
        // if($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount'])
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['note'];
        //     $journal_entry->debit_credit    = 1;
        //     if($data['commission_type'] == 1)
        //     {
        //         $journal_entry->amount = $agent_commission_amount;
        //     }
        //     else
        //     {
        //         $journal_entry->amount = $data['agentcommissionAmount'];
        //     }

        //     $journal_entry->account_name_id = 30;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->agent_id        = $data['agent_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;
        //     $journal_entry->save();

        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     if($data['commission_type'] == 1)
        //     {
        //         $journal_entry->amount = $agent_commission_amount;
        //     }
        //     else
        //     {
        //         $journal_entry->amount = $data['agentcommissionAmount'];
        //     }
        //     $journal_entry->account_name_id = 11;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->agent_id        = $data['agent_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;
        //     $journal_entry->save();
        // }
        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $invoice->personal_note;
        $journal_entry->debit_credit    = 1;
        
        
        if($visa->type==5){
            $journal_entry->account_id      = 1;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->amount          = $invoice->amount;
             $journal_entry->contact_id     = $invoice->vendor_id;
             $journal_entry->bill_id        = $invoice->id;
        }else{
            $journal_entry->account_id          = $invoice->account_id;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->amount          = $invoice->total;
             $journal_entry->contact_id      = $invoice->customer_id;
             $journal_entry->invoice_id      = $invoice->id;
        }
        
        $journal_entry->visa_id         = $visa->id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;

        if($journal_entry->save())
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        // if($discount>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 1;
        //     $journal_entry->amount          = $discount;
        //     $journal_entry->account_name_id = 21;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //insert tax total as credit
        // if($data['tax_total']>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     $journal_entry->amount          = $data['tax_total'];
        //     $journal_entry->account_name_id = 9;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }

        // //insert shipping charge as credit
        // if($data['shipping_charge']>0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note            = $data['customer_note'];
        //     $journal_entry->debit_credit    = 0;
        //     $journal_entry->amount          = $data['shipping_charge'];
        //     $journal_entry->account_name_id = 20;
        //     $journal_entry->jurnal_type     = "invoice";
        //     $journal_entry->invoice_id      = $invoice_id;
        //     $journal_entry->contact_id      = $data['customer_id'];
        //     $journal_entry->created_by      = $user_id;
        //     $journal_entry->updated_by      = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //insert adjustment as credit
        // if($data['adjustment'] != 0)
        // {
        //     $journal_entry = new JournalEntry;
        //     $journal_entry->note                = $data['customer_note'];
        //     if($data['adjustment']>0)
        //     {
        //         $journal_entry->debit_credit    = 0;
        //     }
        //     else
        //     {
        //         $journal_entry->debit_credit    = 1;
        //     }
        //     $journal_entry->amount              = abs($data['adjustment']);
        //     $journal_entry->account_name_id     = 18;
        //     $journal_entry->jurnal_type         = "invoice";
        //     $journal_entry->invoice_id          = $invoice_id;
        //     $journal_entry->contact_id          = $data['customer_id'];
        //     $journal_entry->created_by          = $user_id;
        //     $journal_entry->updated_by          = $user_id;

        //     if($journal_entry->save())
        //     {

        //     }
        //     else
        //     {
        //         //delete all journal entry for this invoice...
        //         $invoice = Invoice::find($invoice_id);
        //         $invoice->delete();
        //         return false;
        //     }
        // }


        // //return $account_array;
        // $invoice_entry = [];
        // for($j = 1; $j<count($account_array)-2; $j++)
        // {
        //     if ($account_array[$j] != 0)
        //     {
        //         $invoice_entry[] = [
        //             'note'              => $data['customer_note'],
        //             'debit_credit'      => 0,
        //             'amount'            => $account_array[$j],
        //             'account_name_id'   => $j,
        //             'jurnal_type'       => 'invoice',
        //             'invoice_id'        => $invoice_id,
        //             'contact_id'        => $data['customer_id'],
        //             'created_by'        => $user_id,
        //             'updated_by'        => $user_id,
        //             'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
        //             'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
        //         ];

        //     }
        // }

        // if (DB::table('journal_entries')->insert($invoice_entry))
        // {
        //     return true;
        // }
        // else
        // {
        //     //delete all journal entry for this invoice...
        //     $invoice = Invoice::find($invoice_id);
        //     $invoice->delete();
        //     return false;
        // }

        return false;

    }
}
