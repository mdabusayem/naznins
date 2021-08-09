<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('root')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price');
            $table->integer('supplier_id')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('image')->nullable();
            $table->string('product_quantity');
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
        Schema::dropIfExists('products');
    }
}
