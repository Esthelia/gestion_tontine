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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('member_id');
            $table->string('wording');
            $table->string('sum');
            $table->enum('payment', ['journalière', 'hebdomadaire', 'mensuelle'])->default('mensuelle');
            $table->text('quantity');
            $table->text('description');
            $table->string('duration');
            $table->string('Amount_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
