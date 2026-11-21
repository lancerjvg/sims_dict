
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {

            $table->id();

            $table->string('subject_code', 30)->unique();
            $table->string('subject_name', 150);

            $table->text('description')->nullable();

            $table->unsignedTinyInteger('units')->default(3);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
