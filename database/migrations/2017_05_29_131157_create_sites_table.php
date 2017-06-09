<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img')->nullable();
            $table->timestamps();
            $table->string('name');
            $table->integer('cost_center_first')->nullable();
            $table->string('manufacturer' , 100);
            $table->string('address' , 100 );
            $table->string('phone');
            $table->float('lat', 10, 8)->nullable(); //10 digits in total and 8 after the decimal point.
            $table->float('lng', 10, 8)->nullable(); //10 digits in total and 8 after the decimal point.
            $table->integer('company_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
