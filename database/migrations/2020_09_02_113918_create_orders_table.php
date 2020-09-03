<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('customer_id')->unsigned();
      $table->timestamp('deliver_at')->nullable();
      $table->double('discount')->unsigned();
      $table->enum('delivery_status', ['delivered', 'not delivered', 'not answering'])->default('not delivered');
      $table->enum('payment_status', ['paid', 'not paid'])->default('not paid');
      $table->enum('payment_method', ['transfer', 'cash'])->default('cash');
      $table->timestamps();

      $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('orders', function(Blueprint $table) {
      $table->dropForeign('orders_customer_id_foreign');
    });
    Schema::dropIfExists('orders');
  }
}
