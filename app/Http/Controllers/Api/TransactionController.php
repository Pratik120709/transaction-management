<?php
// app/Http/Controllers/Api/TransactionController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();

        // Search by transaction_id
        if ($request->filled('search_transaction_id')) {
            $query->where('transaction_id', 'like', '%' . $request->search_transaction_id . '%');
        }

        // Filter by status
        if ($request->filled('search_status') && $request->search_status !== 'all') {
            $query->where('status', $request->search_status);
        }

        // Get total count for pagination
        $total = $query->count();

        // Apply pagination
        $transactions = $query->orderBy('created_at', 'desc')
            ->skip($request->input('skip', 0))
            ->take($request->input('limit', 10))
            ->get();

        return response()->json([
            'transactions' => $transactions,
            'total' => $total
        ]);
    }
}
