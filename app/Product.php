<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Product extends Model
{
  protected $fillable = ['name', 'type_id', 'price', 'image'];

  protected static function boot() {
    parent::boot();

    static::deleting(function ($product) {
      $product->deleteImage();
    });
  }

  public function type() {
    return $this->belongsTo(Type::class);
  }

  public function preferences() {
    return $this->belongsToMany(Preference::class);
  }

  public function deleteImage() {
    if($this->image) {
      if(Storage::exists($this->image)) {
        Storage::delete($this->image);
      }
    }
  }
}
