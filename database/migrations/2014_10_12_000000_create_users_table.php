<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Username', 50)->unique();
            $table->string('Email', 100)->unique();
            $table->string('Password');
            $table->enum('UserType', ['Admin', 'User', 'BloodCenter']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
