<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name', 100);
            $table->string('url', 255);
            $table->enum('is_parent', ['0', '1'])->default('0');
            $table->enum('is_active', ['0', '1'])->default('0');
            $table->integer('parent_id')->unsigned()->index()->default('0');
            $table->integer('order')->default('0');
            $table->text('image');
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
        Schema::dropIfExists('website_menu');
    }
}
