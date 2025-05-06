<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128);
            $table->text('description');
            $table->integer('price');
            $table->string('image_1', 500)->nullable();
            $table->string('image_2', 500)->nullable();
            $table->string('image_3', 500)->nullable();
            $table->string('image_4', 500)->nullable();
            $table->string('image_5', 500)->nullable();
            $table->boolean('is_repair')->default(true);
            $table->boolean('is_complete')->default(false);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
