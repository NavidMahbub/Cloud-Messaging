<?php

namespace App\Models\Journal;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
     public function paymentReceive()
    {
        return $this->belongsTo('App\Models\MoneyIn\PaymentReceive', 'payment_receive_id');
    }



    // public function paymentMade()
    // {
    //     return $this->belongsTo('App\Models\MoneyOut\PaymentMade', 'payment_made_id');
    // }

    public function expense()
    {
        return $this->belongsTo('App\Models\MoneyOut\Expense', 'expense_id');
    }

    public function income()
    {
        return $this->belongsTo('App\Models\MoneyIn\Income', 'income_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\MoneyIn\Invoice', 'invoice_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill', 'bill_id');
    }

    public function PaymentMade()
    {
        return $this->belongsTo('App\Models\MoneyOut\PaymentMade', 'payment_made_id');
    }

    //  public function bank()
    // {
    //     return $this->belongsTo('App\Models\Bank\Bank', 'bank_id');
    // }

    // public function creditNote()
    // {
    //     return $this->belongsTo('App\Models\Moneyin\CreditNote', 'credit_note_id');
    // }

    public function account()
    {
        return $this->belongsTo('App\Models\Account\Account', 'account_id');
    }

    // public function AccountType()
    // {
    //     return $this->belongsTo('App\Models\AccountChart\AccountType','account_name_id','id','account_type_id');
        
    // }

    public function contact()
    {
        return $this->belongsTo('App\User','contact_id');
    }

    // public function Agent()
    // {
    //     return $this->belongsTo('App\Models\Contact\Agent','agent_id');
    // }

    public function SalesCommission()
    {
        return $this->belongsTo('App\Models\setting\SalesComission','salesComission_id');
    }
}
