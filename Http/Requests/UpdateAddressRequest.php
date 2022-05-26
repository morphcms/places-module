<?php

namespace Modules\Places\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Places\Utils\Table;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => ['required', 'numeric', Rule::exists(Table::countries(), 'id')],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'company_name' => ['nullable', 'string'],
            'line_one' => ['required', 'string'],
            'line_two' => ['nullable', 'string'],
            'city_id' => ['required', 'numeric', Rule::exists(Table::states(), 'id')],
            'state' => ['nullable', 'string'],
            'postcode' => ['nullable', 'string'],
            'delivery_instructions' => ['nullable', 'string'],
            'contact_phone' => ['required', 'string'],
            'shipping_default' => ['boolean'],
            'billing_default' => ['boolean'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
