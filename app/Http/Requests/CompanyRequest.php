<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
    public function rules()
    {
        // Get the company ID from the route (for update)
        $companyId = $this->route('company');

        return [
            'comp_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'comp_name')->ignore($companyId),
            ],
            'comp_email' => [
                'required',
                'email',
                Rule::unique('companies', 'comp_email')->ignore($companyId),
            ],
            'comp_logo' => [
                $companyId ? 'nullable' : 'required', // Required for creation, nullable for update
                'image',
                'mimes:jpeg,png,jpg,svg',
                'dimensions:min_width=100,min_height=100',
            ],
            'comp_website' => [
                'required',
                Rule::unique('companies', 'comp_website')->ignore($companyId),
            ],
        ];
    }

    /**
     * Customize the validation error messages.
     */
    public function messages()
    {
        return [
            'comp_logo.dimensions' => 'The :attribute must be at least 100x100 pixels.',
        ];
    }

    /**
     * Customize the field names in the error messages.
     */
    public function attributes()
    {
        return [
            'comp_name' => 'Company Name',
            'comp_email' => 'Company Email',
            'comp_logo' => 'Company Logo',
            'comp_website' => 'Company Website',
        ];
    }
}
