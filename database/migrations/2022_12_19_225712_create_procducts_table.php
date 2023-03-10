<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procducts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->longText('content');
            $table->integer('menu_id');
            $table->integer('price');
            $table->integer('price_sale')->nullable();
            $table->integer('active');
            $table->string('thumb');
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
        Schema::dropIfExists('procducts');
    }
}
