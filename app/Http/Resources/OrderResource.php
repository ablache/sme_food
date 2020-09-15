<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        'customer' => CustomerResource::make($this->customer()->first()),
        'products' => ProductOrderResource::collection($this->products()->get()),
        'deliver_date' => ($this->deliver_at != null) ? $this->deliver_at->format('Y-m-d') : null,
        'deliver_hour' => ($this->deliver_at != null) ? $this->deliver_at->format('h') : null,
        'deliver_minute' => ($this->deliver_at != null) ? $this->deliver_at->format('i') : null,
        'delivery_status' => $this->delivery_status,
        'discount' => $this->discount,
        'payment_method' => $this->payment_method,
        'payment_status' => $this->payment_status,
      ];
  }
}
