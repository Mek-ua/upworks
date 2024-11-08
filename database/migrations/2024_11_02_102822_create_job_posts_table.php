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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->float('budget');
            $table->json('required_skills')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->timestamps();
    
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
