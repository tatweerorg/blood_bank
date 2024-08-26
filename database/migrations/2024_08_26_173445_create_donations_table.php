<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('donations', function (Blueprint $table) {
            $table->id('DonationID');
            $table->foreignId('DonorID')->constrained('donors', 'DonorID');
            $table->foreignId('CenterID')->constrained('blood_centers', 'CenterID');
            $table->enum('BloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->integer('Quantity');
            $table->dateTime('DonationDate');
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
        Schema::dropIfExists('donations');
    }
}
