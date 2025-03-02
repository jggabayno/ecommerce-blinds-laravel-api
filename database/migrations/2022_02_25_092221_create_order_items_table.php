<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('color_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('size_id')->constrained()->onDelete('cascade');
            $table->string('ctrl');
            $table->integer('quantity');
            $table->string('product_name');
            $table->string('color_name');
            $table->string('size_name');
            $table->integer('unit_price');
            $table->integer('_profit');
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
        Schema::dropIfExists('order_items');
    }
}
