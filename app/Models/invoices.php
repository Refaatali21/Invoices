<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use HasFactory ,SoftDeletes;


    protected $fillable = [
        'invoice_number',
        'Due_date',
        'invoice_Date',
        'product',
        'section_id',
        'Amount_Commission',
        'Amount_collection',
        'Discount',
        'Value_VAT',
        'Rate_VAT',
        'Total',
        'status',
        'value_status',
        'note',
        'payment_date',
        'number',
        'email',
        'customer_name',
    ];

    public function  section()
    {
        return $this->belongsTo(Sections::class, 'section_id' , 'id');
    }
}
