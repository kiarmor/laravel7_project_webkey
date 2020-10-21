<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->enum('paid', ['yes', 'no'],)->default('no');
            $table->float('current_cashback')->default(0);
            $table->float('cashback_per_month')->nullable();
            $table->date('day_of_buy')->default(today());
            $table->float('total_paid')->nullable();
            $table->enum('user_get_cashback', ['yes', 'no'])->default('no');
            $table->bigInteger('card_number')->nullable()->default(null);
            $table->enum('payback_status', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_orders');
    }
}
