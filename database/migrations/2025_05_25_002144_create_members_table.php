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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained('families');
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('phone');
            $table->text('domicile');
            $table->string('avatar');
            $table->string('family_status');
            $table->string('mariage_status');
            $table->string('job_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
