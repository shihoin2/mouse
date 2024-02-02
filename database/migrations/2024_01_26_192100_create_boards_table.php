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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('boards_name')->nullable()->change();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tpl_id')->constrained('templates');
            $table->longText('edited_html');
            $table->string('board_thumbnail')->nullable()->change();
            $table->timestamps();
        });
    }

  /**
   * Reverse the migrations.
   */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};