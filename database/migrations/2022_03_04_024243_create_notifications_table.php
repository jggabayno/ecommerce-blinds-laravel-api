<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Order Submitted
            $table->longText('content'); // your order {order_number} has been submitted and is awaiting confirmation from staff.
            $table->integer('type'); // NotificationTypeUtils or you can create helpers which includes number statuses.
            $table->integer('reference_id')->nullable(); // order id
            $table->string('physical_number')->nullable(); // order number
            $table->boolean('is_seen')->default(0);
            $table->boolean('is_read')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
