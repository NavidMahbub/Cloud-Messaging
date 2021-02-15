<?php

namespace App\Http\Controllers\PaymentMade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoneyOut\PaymentMade;
use App\Http\Resources\PaymentMade\PaymentMade as PaymentMadeResource;
use App\Lib\Helper;
class PaymentMadeController extends Controller
{
    public function __construct()
    {
        $Helper = new Helper;
    }

    public function index(Request $request)
    {
        
        $vendor_id     = ($request->has('vendor_id'))?$request['vendor_id']:null;
        $account_id     = ($request->has('account_id'))?$request['account_id']:null;
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
        $bill  = PaymentMade::when($contact_id, function($q) use($contact_id){return $q->where('vendor_id', $contact_id);})
        ->orderBy('id', 'desc')->paginate(50);
        return PaymentMadeResource::collection($bill);
    }

    public function store(Request $request){
        $data = $request->all();
        $PaymentMade = $request->isMethod('put') ? PaymentMade::findOrFail($request->id) : new PaymentMade;
        $PaymentMade ->payment_date = $request->input('date');
        $PaymentMade ->vendor_id = $request->input('customer_id');
        $PaymentMade ->amount = $request->input('amount');
        $PaymentMade ->reference = $request->input('reference');
        $PaymentMade ->payment_mode_id = $request->input('payment_mode_id');
        $request -> isMethod('post') ? $PaymentMade ->pm_number = "PM-1455-".sprintf('%07d',$this->getlastid()):'';
        $log_user = Auth()->user();
        $request->isMethod('put') ?  $PaymentMade ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $PaymentMade ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $PaymentMade ->updated_by = $log_user->id : '' ;

        if($PaymentMade->save()){
            // $id,$visa_id,$account_id,$amount,$contact_id,$jurnal_type
            $Helper = new Helper;
            if($Helper->ManualJournalEntries($PaymentMade->id,null,1,$PaymentMade->amount,$PaymentMade->vendor_id,'','payment_made')
             ){
                return new PaymentMadeResource($PaymentMade);
            }else{
                $PaymentMade->delete();
                 return response()->json(['errors'=>['status' => false , 'message' => 'Some Thing Error']] , 400);
            }
            
        }
    }

    public function  getlastid(){
        $lastid = PaymentMade::orderBy('id','DESC')->first();
        if($lastid){
            return $lastid->id+1;
        }else{
           return 1; 
        }
    }

    public function destroy($id)
    {
        $bill = PaymentMade::findOrFail($id);

        if($bill->delete()){
            return new PaymentMadeResource($bill);
        }
    }
}
