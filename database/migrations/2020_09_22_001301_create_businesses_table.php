<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_active');
            $table->string('name', 15);
            $table->text('address');
            $table->text('hours');
            $table->string('est_date', 15);
            $table->text('description');
            $table->integer('dollar_rating');
            $table->string('web_url', 120);
            $table->string('menu_url', 120);
            $table->string('contact_phone', 11);
            $table->string('contact_email', 64);
            $table->integer('view_count');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
