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
        Schema::create('payloads', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
                
            $table->uuid('parent_id')->nullable();
            $table->string('label');
            $table->string('type');
            $table->json('answer')->nullable();
            // $table->json('value')->nullable();
            $table->string('sub_type')->nullable();
            $table->json('support_file')->nullable();
            $table->enum("orm_only",["no","yes"]);
            $table->text('description');
            $table->uuid('sub_payload_id')->nullable(); // Self-referencing FK


            

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('payloads', function (Blueprint $table) {
            // $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('forms')->onDelete('set null');
            $table->foreign('sub_payload_id')->references('id')->on('payloads')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payloads');
    }
};
