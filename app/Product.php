<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name', 'type_id', 'price', 'image'];

  public function productType() {
    return $this->belongsTo(Type::class);
  }

  public function productPreferences() {
    return $this->belongsToMany(Preference::class);
  }
}
