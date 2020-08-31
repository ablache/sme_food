<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('supplier_id')->unsigned();
      $table->string('description');
      $table->double('price');
      $table->timestamps();

      $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('expenses', function(Blueprint $table) {
      $table->dropForeign('expenses_supplier_id_foreign');
    });
    Schema::dropIfExists('expenses');
  }
}
