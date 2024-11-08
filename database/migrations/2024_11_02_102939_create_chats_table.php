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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_client_id')->nullable();
            $table->unsignedBigInteger('sender_freelancer_id')->nullable();
            $table->unsignedBigInteger('receiver_client_id')->nullable();
            $table->unsignedBigInteger('receiver_freelancer_id')->nullable();
            $table->longText('message');
            $table->tinyInteger('is_read')->default(0);
            $table->timestamps();
    
            $table->foreign('sender_client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('sender_freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
            $table->foreign('receiver_client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('receiver_freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
