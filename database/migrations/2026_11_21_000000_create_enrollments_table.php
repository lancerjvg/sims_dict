<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Safe guard: do not attempt to recreate an existing enrollments table.
        if (Schema::hasTable('enrollments')) return;

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('school_year', 20);
            $table->string('semester', 30);
            $table->date('enrollment_date');
            $table->string('status', 20)->default('Active');
            $table->timestamps();
            $table->unique(['student_id', 'subject_id', 'school_year', 'semester'], 'enrollment_unique_subject_period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
