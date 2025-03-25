<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('Posts', function (Blueprint $table) {
            $table->id();
            $table->string('Title', 100);
            $table->string('Description', 500);
            $table->integer('Price');
            $table->boolean('IsRepair')->default(false);
            $table->boolean('IsComplete')->default(false);
            $table->foreignId('CategoryId')->constrained()->onDelete('cascade');
            $table->foreignId('UserId')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Posts');
    }
};
