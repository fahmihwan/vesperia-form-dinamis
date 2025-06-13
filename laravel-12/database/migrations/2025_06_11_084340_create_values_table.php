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
        Schema::create('values', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->uuid('parent_id');
            $table->string("value");
            $table->string("label");
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('parent_id')->references('id')->on('payloads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('values');
    }
};
