<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('type_id')->unsigned();
      $table->string('name');
      $table->double('price');
      $table->string('image');
      $table->enum('status', ['unavailable', 'available'])->default('available');
      $table->timestamps();

      $table->foreign('type_id')->references('id')->on('types')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('products', function(Blueprint $table) {
      $table->dropForeign('products_type_id_foreign');
    });
    Schema::dropIfExists('products');
  }
}
