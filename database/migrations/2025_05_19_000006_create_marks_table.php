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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->string('exam_type'); // midterm, final, assignment, etc.
            $table->decimal('obtained_marks', 5, 2);
            $table->decimal('total_marks', 5, 2);
            $table->decimal('percentage', 5, 2)->nullable();
            $table->string('grade')->nullable();
            $table->boolean('is_passed')->default(false);
            $table->date('exam_date')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('uploaded_by'); // admin id
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('admins')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
