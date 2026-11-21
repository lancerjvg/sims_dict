
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->cascadeOnDelete();

            $table->string('school_year', 20);
            $table->string('semester', 30);

            $table->date('enrollment_date');

            $table->string('status', 20)->default('Active');

            $table->timestamps();

            // Prevent duplicate enrollment in the same
            // subject during the same semester/year.
            $table->unique(
                ['student_id', 'subject_id', 'school_year', 'semester'],
                'enrollment_unique_subject'
            );

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
