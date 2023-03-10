<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;


    protected $fillable = [
        'invoice_number',
        'id_invoice',
        'product',
        'Section',
        'status',
        'value_status',
        'note',
        'user',
    ];

}
