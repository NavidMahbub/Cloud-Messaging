<?php

namespace App\Models\MoneyIn;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'date',
        'due_date',
        'customer_id',
        'account_id',
        'visa_id',
        'agent_id',
        'commission_type',
        'commission_amount',
        'invoice_items',
        'shipping_charge',
        'adjustment',
        'total',
        'amount',
        'mode',
        'down_payment',
        'installment_type',
        'total_installment',
        'per_installment_amount',
        'payment_id',
        'personal_note',
        'customer_note',
        'created_by',
        'updated_by'
    ];

    protected $table = 'invoices';

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User','customer_id');
    }
    public function visa()
    {
        return $this->belongsTo('App\Models\Recruiting\Visa','
            visa_id');
    }

    public function AccountInfo(){
        return $this->belongsTo('App\Models\Account\Account','
            account_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
