<?php
// app/Models/TransactionJob.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionJob extends Model
{
    use HasFactory;

    protected $table = 'transaction_job';

    protected $fillable = [
        'date',
        'total_amount'
    ];

    protected $casts = [
        'date' => 'date',
        'total_amount' => 'decimal:2',
    ];
}
