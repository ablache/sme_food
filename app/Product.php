<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name', 'type_id', 'price', 'image'];

  public function type() {
    return $this->belongsTo(Type::class);
  }

  public function preferences() {
    return $this->belongsToMany(Preference::class);
  }
}
