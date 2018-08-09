<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->enum('product_condition', ['0', '1'])->default('1')->comment = "0 for upcoming, 1 for existing";
            $table->longText('upcoming_news_content');
            $table->integer('product_types_id')->default('0')->unsigned()->index();
            $table->string('title', 100)->unique();
            $table->string('url', 100)->unique()->index();
            $table->string('background_image', 255);
            $table->string('overview_image', 255);
            $table->enum('featured_product', ['0', '1'])->default('0');
            $table->string('banner_image', 255);
            $table->string('home_thumb_image', 255);
            $table->string('list_thumb_image', 255);
            $table->longText('overview');
            $table->longText('home_page_description');
            $table->longText('product_list_page_description');
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->timestamp('created_at');
            $table->integer('created_by')->default('0');
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('updated_by')->default('0');
        });

        Schema::table('product', function($table) {
           $table->foreign('product_types_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
