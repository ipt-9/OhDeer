<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id();
            $table->string('Username', 50);
            $table->string('Password');
            $table->string('Email')->unique();
            $table->integer('RepairRating')->default(0);
            $table->integer('GeneralRating')->default(0);
            $table->string('Address', 100);
            $table->bigInteger('PhoneNumber');
            $table->string('IBAN', 34);
            $table->string('HashSalt', 50);
            $table->foreignId('UserTypeId')->constrained()->onDelete('cascade');
            $table->foreignId('LanguageId')->constrained()->onDelete('cascade');
            $table->foreignId('SubscriptionId')->constrained()->onDelete('cascade');
            $table->timestamp('EmailVerifiedAt')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Users');
    }

};
