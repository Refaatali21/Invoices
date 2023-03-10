<?php

namespace Database\Seeders;

use App\Models\Sections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) {
            $add = new Sections;
        $add->section_name = 'add name section_name';
        $add->description = 'add description';
        $add->created_by = 'add id created_by';
        }
    }
}
