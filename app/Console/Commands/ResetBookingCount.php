<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\customer;
use App\Models\Book;
use Carbon\Carbon;
class ResetBookingCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:booking-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset booking count for all owners';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { $cutoffTime=Carbon::now()->subHours(2);
        Book::where('created_at', '<=', $cutoffTime)->update(['booking' => 0]);
        $this->info('Booking count reset successfully.');
       
    }
}
