<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class OrderRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'customer_id' => 'required|numeric',
      'discount' => 'required|numeric|min:0|max:100',
      'delivery_status' => 'required|in:delivered, "not delivered", "not answering"',
      'deliver_at' => 'nullable|date',
      'payment_status' => 'required|in: paid,"not paid"',
      'payment_method' => 'required|in:transfer,cash',
      'products' => 'required',
    ];
  }

  public function messages() {
    return [
      'customer_id.required' => 'The customer is required.',
      'products.required' => 'Products are required.'
    ];
  }
}
