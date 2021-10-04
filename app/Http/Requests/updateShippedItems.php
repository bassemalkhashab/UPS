<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateShippedItems extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'weight' => 'required|integer',
            'dimension' => 'required|string',
            'insuranceAmount' => 'required|integer',
            'destination' => 'required|string',
            'finalDeliveryDate' => 'required|date_format:Y-m-d'
        ];
    }
}
