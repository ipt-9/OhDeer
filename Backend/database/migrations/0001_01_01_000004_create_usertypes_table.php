<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('user_type_name', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_types');
    }
};
