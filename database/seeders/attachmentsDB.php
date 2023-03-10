<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\invoices_attachments;

class attachmentsDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            $add = new invoices_attachments;
                $add->invoice_number = 'add name products_name';
                $add->invoice_id = 'add name products_name';
                $add->file_name = 'add id created_by';
                $add->created_by = 'add id created_by';
        }
    }
}
