<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTouchPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touch_points', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('district_id')->default('0')->unsigned()->index();
            $table->integer('thana_id')->default('0')->unsigned()->index();
            $table->string('name', 255);
            $table->text('address');
            $table->string('contact_person', 255);
            $table->string('contact_phone', 255);
            $table->string('email', 255)->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->integer('point_type')->default('0')->unsigned()->index();
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 8, 6);
            $table->timestamp('created_at');
            $table->integer('created_by')->default('0');
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('updated_by')->default('0');
        });

        Schema::table('touch_points', function($table) {
           $table->foreign('district_id')->references('id')->on('district')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('thana_id')->references('id')->on('thana')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('touch_points');
    }
}
