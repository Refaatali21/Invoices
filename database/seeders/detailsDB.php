<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\invoices_details;

class detailsDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
        $add = new invoices_details;
            $add->invoice_number = 'add name products_name';
            $add->product = 'add id created_by';
            $add->section = 'add id created_by';
            $add->status = 'add id created_by';
            $add->value_status = 'add id created_by';
            $add->note = 'add id created_by';
            $add->user = 'add id created_by';
    }
}
}
