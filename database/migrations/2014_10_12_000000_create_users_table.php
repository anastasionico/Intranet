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
            $table->integer('department_id')->default(1); //This is a test default change it after I create the department table;
            $table->string('email')->unique();
            $table->string('job_title')->nullable();
            $table->integer('expenses_auth_id')->nullable();
            $table->integer('expenses_mileage_rate')->nullable();
            $table->integer('holiday_manager')->nullable();
            $table->integer('holiday_total')->nullable();
            $table->integer('holiday_taken')->nullable();
            $table->integer('holiday_outstanding')->nullable();
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
