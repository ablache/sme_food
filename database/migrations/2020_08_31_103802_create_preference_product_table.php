<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('preference_product', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('product_id')->unsigned();
      $table->bigInteger('preference_id')->unsigned();
      
      $table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
      $table->foreign('preference_id')->references('id')->on('preferences')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('preference_product', function(Blueprint $table) {
      $table->dropForeign('preference_product_product_id_foreign');
      $table->dropForeign('preference_product_preference_id_foreign');
    });
    Schema::dropIfExists('preference_product');
  }
}
