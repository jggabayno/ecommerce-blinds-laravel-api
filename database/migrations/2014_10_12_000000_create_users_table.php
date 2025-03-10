<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_type_id')->constrained()->onDelete('cascade');
            $table->string('user_name')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo')->nullable();
            $table->string('mobile_number')->unique();
            $table->longText('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
