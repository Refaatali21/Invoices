<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
        $add = new products;
        $add->products_name = 'add name products_name';
        $add->description = 'add description';
        $add->created_by = 'add id created_by';
        }
    }
}

