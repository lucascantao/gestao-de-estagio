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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona as foreign keys
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained('roles');

            $table->foreignId('course_id')
                ->nullable()
                ->after('role_id')
                ->constrained('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Primeiro remove as constraints
            $table->dropForeign(['role_id']);
            $table->dropForeign(['course_id']);

            // Depois remove as colunas
            $table->dropColumn(['role_id', 'course_id']);
        });
    }
};
