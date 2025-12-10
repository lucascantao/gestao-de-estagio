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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100);
            $table->text('description');
            $table->integer('number_of_positions');
            $table->string('requirements', 255)->nullable();
            $table->string('salary', 20)->nullable();
            $table->date('application_deadline');
            $table->boolean('active')->default(true);
            $table->timestamp('deleted_at')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
