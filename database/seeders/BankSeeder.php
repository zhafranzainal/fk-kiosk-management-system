<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::create(['name' => 'Affin Bank']);
        Bank::create(['name' => 'Agrobank']);
        Bank::create(['name' => 'Al-Rajhi Malaysia']);
        Bank::create(['name' => 'Alliance Bank Malaysia Berhad']);
        Bank::create(['name' => 'AmBank']);
        Bank::create(['name' => 'Bank Islam Malaysia Berhad']);
        Bank::create(['name' => 'Bank Muamalat Malaysia Berhad']);
        Bank::create(['name' => 'Bank Rakyat']);
        Bank::create(['name' => 'Bank Simpanan Nasional (BSN)']);
        Bank::create(['name' => 'CIMB Group Holdings']);

        Bank::create(['name' => 'CIMB Islamic Bank']);
        Bank::create(['name' => 'Citibank Malaysia']);
        Bank::create(['name' => 'Hong Leong Bank']);
        Bank::create(['name' => 'HSBC Bank Malaysia']);
        Bank::create(['name' => 'Kuwait Finance House']);
        Bank::create(['name' => 'Maybank']);
        Bank::create(['name' => 'MBSB Bank Berhad']);
        Bank::create(['name' => 'OCBC Bank Malaysia']);
        Bank::create(['name' => 'Public Bank Berhad']);
        Bank::create(['name' => 'RHB Bank']);

        Bank::create(['name' => 'Standard Chartered Bank Malaysia']);
        Bank::create(['name' => 'UOB Malaysia']);
    }
}
