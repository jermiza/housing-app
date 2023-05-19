<?php

namespace App\Http\Requests;

use App\Models\PropertyType;
use Illuminate\Foundation\Http\FormRequest;

class StatementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:250',
            'price' => 'required|integer',
            'active' => 'nullable|boolean',
            'address' => 'required|max:250',
            'currency' => 'nullable|string|in:gel,eur,usd',
            'property_type_id' => 'nullable|exists:property_types,id',
            'floors' => 'nullable|integer|between:1,50',
            'user_id' => 'required',
        ];

        if ($this->input('property_type_id') && $propertType = PropertyType::select('name')->where('active', true)->findOrFail($this->input('property_type_id'))) {
            if ($propertType->name === 'ბინა') {
                $rules['floors'] = 'required|integer';
            }
        }

        return $rules;
    }
}
