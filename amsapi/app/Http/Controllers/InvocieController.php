<?php

namespace App\Http\Controllers;

use App\Models\MoneyIn\Invoice;
use Illuminate\Http\Request;
use Sentinel;
use App\RoleUser;
use App\Http\Resources\Invoice as InvoiceResource;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoice  = Invoice::paginate(10);
        return InvoiceResource::collection($invoice);
    }

    public function store(Request $request)
    {
        $invoice = $request->isMethod('put') ? Invoice::findOrFail($request->invoice_id) : new Invoice;
        $invoice -> date = $request->input('date');
        $invoice -> due_date = $request->input('due_date');
        $invoice -> customer_id = $request->input('customer_id');
        $invoice -> visa_id = $request->input('visa_id');
        $invoice -> agent_id = $request->input('agent_id');
        $invoice -> account_id = $request->input('account_id');
        $invoice -> commission_type = $request->input('commission_type');
        $invoice -> commission_amount = $request->input('commission_amount');
        $invoice -> adjustment = $request->input('adjustment');
        $invoice -> total = $request->input('total');
        $invoice -> due_amount = $request->input('due_amount');
        $invoice -> personal_note = $request->input('personal_note');
        $invoice -> customer_note = $request->input('customer_note');
        $request -> isMethod('post') ? $invoice -> invoice_number = "INV-".time() : '' ;
        // $invoice -> invoice_items = json_encode($request->input('invoice_items'));
        $request->invoice_type == 1 ?  $invoice -> invoice_items = null : $invoice -> invoice_items = json_encode($request->input('invoice_items'));
        $log_user = Auth()->user();
        $request->isMethod('put') ?  $invoice ->updated_by = $log_user->id : '' ;
        $request->isMethod('post') ? $invoice ->created_by = $log_user->id : '' ;
        $request->isMethod('post') ? $invoice ->updated_by = $log_user->id : '' ;

        if($invoice->save()){
            return new InvoiceResource($invoice);
        }
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        if($invoice->delete()){
            return new InvoiceResource($invoice);
        }
    }
    
    public function unpaidInvoice($id){
        $invoices = Invoice::where('customer_id', $id)->where('due_amount','>', 0)->get();
        return InvoiceResource::collection($invoices);
    }
}
