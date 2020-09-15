<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'type' => TypeResource::make($this->type()->first()),
      'name' => $this->name,
      'price' => $this->price,
      'preferences' => json_decode($this->pivot->preferences),
      'quantity' => $this->pivot->quantity,
    ];
  }
}
