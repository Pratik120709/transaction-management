<?php
// database/migrations/2024_01_01_000002_create_transaction_job_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaction_job', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->decimal('total_amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_job');
    }
};
