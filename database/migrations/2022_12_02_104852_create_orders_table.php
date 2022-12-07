<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->string('user_id');
            $table->string('package_id');
            $table->integer('user_address_id')->nullable();
            $table->date('date');
            $table->integer('adult_qty');
            $table->integer('child_qty');
            $table->integer('infant_qty');
            $table->double('price');
            $table->string('tax');
            $table->string('order_status')->comment('In Progress, Cancelled, Completed, Confirmed');
            $table->string('razorpay_payment_id');
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
        Schema::dropIfExists('orders');
    }
}
