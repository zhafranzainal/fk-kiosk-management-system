<?php

namespace App\Console\Commands;

use App\Http\Controllers\PaymentController;
use Illuminate\Console\Command;

class GenerateMonthlyBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly-bill:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly bills at the beginning of each month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentController = new PaymentController();
        $paymentController->generateBill(new \Illuminate\Http\Request());
        $this->info('Monthly bills generated successfully.');
    }
}
