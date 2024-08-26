<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_transfers', function (Blueprint $table) {
            $table->id('TransferID');
            $table->foreignId('FromCenterID')->constrained('blood_centers', 'CenterID');
            $table->foreignId('ToCenterID')->constrained('blood_centers', 'CenterID');
            $table->enum('BloodType', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->integer('Quantity');
            $table->dateTime('TransferDate');
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
        Schema::dropIfExists('blood_transfers');
    }
}
