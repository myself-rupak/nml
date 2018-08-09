<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWiseSpecificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wise_specification', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->default('0')->unsigned()->index();
            $table->integer('product_specification_id')->default('0')->unsigned()->index();
            
            $table->string('specification_detail', 100);
            $table->timestamp('created_at');
            $table->integer('created_by')->default('0');
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('updated_by')->default('0');
            $table->unique(['product_id', 'product_specification_id'], 'pid_psid_unique');
        });

        Schema::table('product_wise_specification', function($table) {
           $table->foreign('product_id','pid_pwsid')->references('id')->on('product')->onDelete('cascade');
           $table->foreign('product_specification_id', 'psid_pwsid')->references('id')->on('product_specification')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_wise_specification');
    }
}
