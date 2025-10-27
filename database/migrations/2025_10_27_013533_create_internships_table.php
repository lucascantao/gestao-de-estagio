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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->integer('workload');
            $table->string('schedule', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('salary', 20);
            $table->string('observation', 255)->nullable();
            $table->string('supervisor', 100)->nullable();

            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('internship_status_id')->constrained('internship_status');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
