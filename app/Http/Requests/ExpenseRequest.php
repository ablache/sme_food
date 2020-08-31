<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ExpenseRequest extends FormRequest
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
      'description' => 'required',
      'price' => 'required|numeric',
      'supplier_id' => 'required|numeric',
    ];
  }

  public function messages() {
    return [
      'supplier_id.required' => 'The supplier field is required.',
    ];
  }
}
