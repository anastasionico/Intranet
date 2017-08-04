<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $t)
        {
            $t->renameColumn('expenses_auth_id', 'manager_id');
            $t->dropColumn('holiday_manager');
            $t->integer('level')->unsigned()->default(0);
            $t->boolean('on_holiday')->default(0);
            
            $t->dropColumn('job_title');
            $t->integer('job_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $t){
            $t->renameColumn('manager_id', 'expenses_auth_id');            
            $t->integer('holiday_manager');
            $t->dropColumn('level','on_holiday');

            $t->integer('job_title');
            $t->dropColumn('job_id');
        });
    }
}
