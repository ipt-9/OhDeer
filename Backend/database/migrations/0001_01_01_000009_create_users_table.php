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
            $table->string('email', 75)->unique();
            $table->integer('repair_rating')->default(3);
            $table->integer('general_rating')->default(3);
            $table->integer('postal_code');
            $table->string('address', 100);
            $table->string('phone_number', 50)->nullable();
            $table->string('iban', 40)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('profile_image', 100)->default(asset('OhDeerPlaceholder.png'));
            $table->foreignId('user_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

};
