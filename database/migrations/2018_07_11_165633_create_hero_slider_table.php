<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_slider', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->longText('mobile_description');
            $table->string('slider_image', 255);
            $table->string('mobile_slider_image', 255);
            $table->integer('template')->default('0');
            $table->enum('is_active', ['0', '1'])->default('0');
            $table->timestamp('created_at');
            $table->integer('created_by')->default('0');
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('updated_by')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hero_slider');
    }
}
