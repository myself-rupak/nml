<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_center', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->longText('content');

            $table->string('image_1', 255);
            $table->string('image_2', 255);
            $table->string('image_3', 255);
            $table->string('image_4', 255);
            
            $table->enum('is_active', ['0', '1'])->default('1');
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
        Schema::dropIfExists('media_center');
    }
}
