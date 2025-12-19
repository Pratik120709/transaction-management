<?php
// app/Jobs/CalculateYesterdayTotal.php
namespace App\Jobs;

use App\Models\Transaction;
use App\Models\TransactionJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateYesterdayTotal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $yesterday = now()->subDay()->toDateString();

        $totalAmount = Transaction::where('status', 'success')
            ->whereDate('created_at', $yesterday)
            ->sum('amount');

        TransactionJob::updateOrCreate(
            ['date' => $yesterday],
            ['total_amount' => $totalAmount]
        );
    }
}
