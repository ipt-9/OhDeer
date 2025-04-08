<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50);
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('repair_rating')->default(0)->nullable();
            $table->integer('general_rating')->default(0)->nullable();
            $table->string('address', 100)->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('iban', 34)->nullable();
            $table->string('hash_salt', 50)->nullable();
            $table->foreignId('user_type_id')->constrained('usertypes')->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

};
