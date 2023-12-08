<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);

        $this->call(TransactionSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(KioskSeeder::class);
        $this->call(ApplicationSeeder::class);

        $this->call(BankSeeder::class);
        $this->call(KioskParticipantSeeder::class);

        $this->call(CourseSeeder::class);
        $this->call(StudentSeeder::class);

        $this->call(SaleSeeder::class);
        $this->call(ComplaintSeeder::class);
    }
}
