<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('shopname')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
