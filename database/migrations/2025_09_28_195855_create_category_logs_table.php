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
        Schema::create('category_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id',false,true);
            $table->bigInteger('user_id',false,true);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('action', ['created','updated','deleted']);
            $table->json('changes')->nullable();
            $table->timestamp('logged_at');
            $table->timestamps();
            $table->index(['category_id','action','logged_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_logs');
    }
};
