<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('pro_quantity')->nullable();
            $table->text('details')->nullable();
            $table->string('product_price')->nullable();
            $table->string('sub_total')->nullable();
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
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
