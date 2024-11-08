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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->json('portfolio')->nullable();
            $table->text('experience')->nullable();
            $table->json('skills')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('educational_status_id')->nullable();
            // $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('educational_status_id')->references('id')->on('educational_statuses');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('role_id')->references('id')->on('roles');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
