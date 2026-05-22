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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); // admin id
            $table->string('title');
            $table->text('content');
            $table->string('type')->default('general'); // general, urgent, academic, etc.
            $table->string('attachment_path')->nullable();
            $table->date('publish_date');
            $table->date('expire_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('views')->default(0);
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
