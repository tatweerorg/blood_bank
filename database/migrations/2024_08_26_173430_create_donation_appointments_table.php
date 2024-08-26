<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_appointments', function (Blueprint $table) {
            $table->id('AppointmentID');
            $table->foreignId('DonorID')->constrained('donors', 'DonorID');
            $table->foreignId('CenterID')->constrained('blood_centers', 'CenterID');
            $table->dateTime('AppointmentDate');
            $table->enum('Status', ['Scheduled', 'Completed', 'Cancelled']);
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
        Schema::dropIfExists('donation_appointments');
    }
}
