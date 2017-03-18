<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("news", function(Blueprint $table) {
            $table->increments('id');
            $table->mediumText('news');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->boolean('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("news");
    }
}
