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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('roll_number')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('status', ['active', 'blocked', 'inactive'])->default('inactive');
            $table->boolean('is_approved')->default(false);
            $table->string('avatar')->default('default-avatar.png');
            $table->decimal('total_fees', 10, 2)->default(0);
            $table->decimal('fees_paid', 10, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
