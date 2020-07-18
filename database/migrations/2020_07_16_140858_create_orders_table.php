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
            $table->bigIncrements('id_order');
            $table->string('order');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('email_address');
            $table->string('mobile_number');
            $table->double('total_price');
            $table->timestamp('created_order_at')->useCurrent();
            $table->timestamp('updated_order_at')->nullable();
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
