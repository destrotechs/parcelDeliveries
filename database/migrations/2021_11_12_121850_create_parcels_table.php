<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('percel_no')->unique();
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('sender_idnumber')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone');
            $table->string('receiver_idnumber')->nullable();
            $table->string('weight')->nullable();
            $table->integer('source_station_id');
            $table->integer('destination_station_id');
            $table->string('quantity')->nullable();
            $table->string('cost');
            $table->string('payment_mode')->default('Cash');
            $table->string('status')->default('on transit');
            $table->date('send_date');
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
        Schema::dropIfExists('parcels');
    }
    public function customers(){
        return $this->morphedByMany(Customer::class,'customer_id');
    }
}
