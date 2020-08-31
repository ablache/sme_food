<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  protected $fillable = [
    'supplier_id',
    'description',
    'price',
  ];

  public function supplier() {
    return $this->belongsTo(Supplier::class);
  }
}
