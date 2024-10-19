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
            $table->id(); // معرف التبرع الفريد
            $table->foreignId('user_id')->constrained('users'); // ربط مع جدول المستخدمين
            $table->foreignId('center_id')->constrained('users'); // ربط مع جدول مراكز الدم (بما أنها مراكز مخزنة في users)
            $table->string('blood_type'); // نوع الدم
            $table->integer('quantity'); // كمية التبرع
            $table->date('last_donation_date'); // تاريخ التبرع الأخير
            $table->timestamps(); // تواريخ الإنشاء والتحديث
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
