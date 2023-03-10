<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SectionDB::class);
        $this->call(ProductDB::class);
        $this->call(invoiceDB::class);
        $this->call(detailsDB::class);
        $this->call(attachmentsDB::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PermissionTableSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
