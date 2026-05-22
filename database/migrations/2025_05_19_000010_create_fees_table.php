<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->decimal('amount', 10, 2);
            $table->enum('fee_type', ['tuition', 'lab', 'library', 'transport', 'other'])->default('tuition');
            $table->date('due_date');
            $table->enum('status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->date('paid_date')->nullable();
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable(); // admin who updated
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
