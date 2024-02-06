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
            $table->string('boards_name')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tpl_id')->constrained('templates')->default(1);
            $table->longText('edited_html');
            $table->string('board_thumbnail')->nullable()->default('http://localhost/storage/demo_thumbnail.png');
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