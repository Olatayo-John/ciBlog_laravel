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
        Schema::create('post_settings', function(Blueprint $table){
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('meta_key');
            $table->string('meta_value')->nullable()->default(null);
            // $table->boolean('is_array')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_settings');
    }
};
