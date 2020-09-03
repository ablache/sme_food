<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_product', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('order_id')->unsigned();
      $table->bigInteger('product_id')->unsigned();
      $table->integer('quantity')->unsigned();
      $table->json('preferences')->nullable();
      $table->timestamps();

      $table->foreign('order_id')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
      $table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('order_product', function(Blueprint $table) {
      $table->dropForeign('order_product_order_id_foreign');
      $table->dropForeign('order_product_product_id_foreign');
    });
    Schema::dropIfExists('order_product');
  }
}
