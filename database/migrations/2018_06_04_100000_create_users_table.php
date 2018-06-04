<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::get('ore.user.table'), function ($table) {
            $table->increments('id'); 
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('password'); 
            $table->boolean('enabled')->default(0);
            $table->string('role')->default('user'); 
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
        Schema::dropIfExists(Config::get('ore.user.table'));
    }
}
