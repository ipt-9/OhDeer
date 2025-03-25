<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('Amount');
            $table->time('Timestamp');
            $table->date('Date');
            $table->boolean('IsOutstanding')->default(false);
            $table->integer('RepairRating');
            $table->integer('GeneralRating');
            $table->text('RatingComment')->nullable();
            $table->foreignId('PostId')->constrained()->onDelete('cascade');
            $table->foreignId('UserId')->constrained()->onDelete('cascade');
            $table->foreignId('FeeId')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Purchases');
    }
};
