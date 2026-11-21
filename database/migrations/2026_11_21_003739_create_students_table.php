
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->string('student_number', 30)->unique();

            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);

            $table->string('gender', 20)->nullable();
            $table->date('birth_date')->nullable();

            $table->string('email')->nullable();
            $table->string('contact_number', 30)->nullable();

            $table->text('address')->nullable();

            $table->string('course', 150);
            $table->unsignedTinyInteger('year_level');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
