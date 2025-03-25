<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Fees', function (Blueprint $table) {
            $table->id();
            $table->boolean('IsPaid')->default(false);
            $table->date('DueDate');
            $table->integer('Amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Fees');
    }
};
