<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToursListRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'priceFrom' => 'numeric',
            'priceTo' => 'numeric',
            'dateFrom' => 'date_format:Y-m-d',
            'dateTo' =>  'date_format:Y-m-d',
            'sortBy' => 'in:price_in_cents',
            'sortOrder' => 'in:asc,desc'
        ];
    }

    public function messages(): array {
        return [
            'dateFrom' => 'Date format should be 2000-01-01 (Y-m-d)',
            'dateTo' => 'Date format should be 2000-01-01 (Y-m-d)',
            'sortBy' => 'The sortBy only accepts price_in_cents',
            'sortOrder' => 'The sortOrder only accepts asc or desc',
        ];
    }
}
