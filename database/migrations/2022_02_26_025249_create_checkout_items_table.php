<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
            $table->unsignedBigInteger('checkout_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('cart_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('color_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('size_id')->constrained()->onDelete('cascade');
            $table->string('ctrl');
            $table->integer('quantity');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_items');
    }
}
