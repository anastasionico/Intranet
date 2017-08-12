<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('last_login')->nullable();
            $table->string('img')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate')->nullable();
            $table->integer('role_id')->unsigned();
            $table->integer('department_id')->unsigned()->default(0);
            $table->string('email')->unique();
            $table->integer('manager_id')->nullable();
            $table->integer('expenses_mileage_rate')->nullable();
            $table->integer('holiday_total')->nullable();
            $table->boolean('on_holiday')->default(0);
            $table->integer('holiday_taken')->nullable();
            $table->integer('holiday_outstanding')->nullable();
            $table->integer('level')->unsigned()->default(0);
            $table->rememberToken();
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
