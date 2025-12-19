<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Jobs\CalculateYesterdayTotal;
use App\Models\TransactionJob;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jobResults = TransactionJob::orderBy('date', 'desc')->get();
        return response()->json($jobResults);
    }

    public function calculateYesterdayTotal()
    {
        CalculateYesterdayTotal::dispatchSync();

        return response()->json([
            'message' => 'Calculation completed successfully',
            'data' => TransactionJob::where('date', now()->subDay()->toDateString())->first()
        ]);
    }
}
