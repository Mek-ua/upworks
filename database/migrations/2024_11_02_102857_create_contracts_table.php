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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_apply_id');
            $table->unsignedBigInteger('job_post_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->longText('terms');
            $table->boolean('is_complete')->default(false);
            $table->float('service_fee')->nullable();
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('job_apply_id')->references('id')->on('job_applies');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('freelancer_id')->references('id')->on('freelancers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
