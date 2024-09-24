<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_centers', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('CenterName', 100); 
            $table->string('Address');
            $table->string('ContactNumber', 20); 
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
        Schema::dropIfExists('blood_centers');
    }
}
