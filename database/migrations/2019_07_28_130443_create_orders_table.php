<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->string('qty')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('vat')->nullable();
            $table->string('total')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->integer('deliverycharge')->default('0');
            $table->string('payby')->nullable();
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->string('status')->default('pending');
            $table->integer('userid')->nullable();
            $table->integer('groupid')->nullable();
            $table->integer('createby')->nullable();
            $table->timestamp('createtime')->nullable();
            $table->integer('updateby')->nullable();
            $table->timestamp('updatetime')->nullable();
            $table->integer('deleteby')->nullable();
            $table->timestamp('deletetime')->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->year('year')->nullable();
            $table->tinyInteger('preorder')->default('0');
            $table->tinyInteger('state')->default('1');
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
