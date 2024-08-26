<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('donors', function (Blueprint $table) {
            $table->id('DonorID');
            $table->foreignId('UserID')->unique()->constrained('users', 'UserID');
            $table->string('FullName', 100);
            $table->enum('BloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->date('DateOfBirth');
            $table->string('ContactNumber', 20);
            $table->text('Address')->nullable();
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
        Schema::dropIfExists('donors');
    }
}
