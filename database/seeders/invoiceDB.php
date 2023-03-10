<?php

namespace Database\Seeders;
use App\Models\invoices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class invoiceDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            $add = new invoices;
            $add->invoice_number = 'add name products_name';
            $add->invoice_Data = 'add description';
            $add->due_data = 'add id created_by';
            $add->product = 'add id created_by';
            $add->section_id = 'add id created_by';
            $add->discount = 'add id created_by';
            $add->Amount_Commission = 'add id created_by';
            $add->Amount_collection = 'add id created_by';
            $add->rate_vat = 'add id created_by';
            $add->value_vat = 'add id created_by';
            $add->total = 'add id created_by';
            $add->status = 'add id created_by';
            $add->value_status = 'add id created_by';
            $add->note = 'add id created_by';
            $add->user = 'add id created_by';
            }
    }
}
