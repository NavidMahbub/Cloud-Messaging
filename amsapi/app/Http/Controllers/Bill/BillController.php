<?php

namespace App\Http\Controllers\Bill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoneyOut\Bill;
use App\Http\Resources\Bill\Bill as BillResource;
use App\Lib\Helper;
use App\Models\Journal\JournalEntry;
class BillController extends Controller
{
     public function __construct()
    {
        $Helper = new Helper;
    }
    public function unpaidBill($id){
        $total_bill  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
                 ->whereNotNull('visas.okala_date')->where('visas.status',1)
                ->select('journal_entries.*')->where('journal_entries.jurnal_type','bill')->where('journal_entries.contact_id',$id)->sum('journal_entries.amount');
        $total_receive = JournalEntry::where('jurnal_type','payment_made')->where('contact_id',$id)->sum('amount');
        $total_due  = $total_bill-$total_receive;
        return $total_due;
    }

    public function index(Request $request)
    {
        
        $vendor_id     = ($request->has('vendor_id'))?$request['vendor_id']:null;
        $account_id     = ($request->has('account_id'))?$request['account_id']:null;
        $visa_id     = ($request->has('visa_id'))?$request['visa_id']:null;
        $contact_id     = ($request->has('customer_id'))?$request['customer_id']:null;
        $cstart_date     = ($request->has('strat_date'))?$request['strat_date']:null;
        $cend_date     = ($request->has('end_date'))?$request['end_date']:null;

        if($cstart_date == null && $cend_date == null)
        {
            $datearray = null;
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
        $bill  = Bill::when($visa_id,function($q) use($visa_id){return $q->where('visa_id', $visa_id);})
        ->when($contact_id, function($q) use($contact_id){return $q->where('vendor_id', $contact_id);})
        ->orderBy('id', 'desc')->paginate(50);
        return BillResource::collection($bill);
    }

    public function store(Request $request){
        $data = $request->all();
        $bill = $request->isMethod('put') ? Bill::findOrFail($request->id) : new Bill;
        $bill ->bill_date = $request->input('date');
        $bill ->due_date = $request->input('due_date');
        $bill ->vendor_id = $request->input('customer_id');
        $bill ->visa_id = $request->input('visa_id');
        $bill ->amount = $request->input('amount');
        $bill ->note = $request->input('note');
        $request -> isMethod('post') ? $bill ->bill_number = "BILL-1455-".sprintf('%07d',$this->getlastid()):'';
        $log_user = Auth()->user();
        $request->isMethod('put') ?  $bill ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $bill ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $bill ->updated_by = $log_user->id : '' ;

        if($bill->save()){
            // $id,$visa_id,$account_id,$amount,$contact_id,$jurnal_type
            $Helper = new Helper;
            if($Helper->ManualJournalEntries($bill->id,$bill->visa_id,1,$bill->amount,$bill->vendor_id,$bill->note,'bill')
             ){
                return new BillResource($bill);
            }else{
                $bill->delete();
                 return response()->json(['errors'=>['status' => false , 'message' => 'Some Thing Error']] , 400);
            }
            
        }
    }

    public function  getlastid(){
        $lastid = Bill::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }

    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);

        if($bill->delete()){
            return new BillResource($bill);
        }
    }
}
