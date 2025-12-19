<?php
// database/seeders/TransactionSeeder.php
namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['pending', 'failed', 'success'];
        $names = ['John Doe', 'Jane Smith', 'Bob Johnson', 'Alice Brown', 'Charlie Wilson'];

        // Generate data for last 3 days
        for ($i = 0; $i < 3; $i++) {
            $date = now()->subDays($i);

            for ($j = 0; $j < 100; $j++) {
                $name = $names[array_rand($names)];
                $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';

                Transaction::create([
                    'transaction_id' => 'TXN' . Str::random(10) . time(),
                    'amount' => rand(100, 10000) / 100, // Random amount between 1.00 and 100.00
                    'name' => $name,
                    'email' => $email,
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
