<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'comp_name' => 'required|string|max:255',
            'comp_email' => 'required|email|unique:companies,email',
            'comp_logo' => 'required|image|mimes:jpeg,png,jpg,svg|dimensions:min_width=100,min_height=100',
            'comp_website' => 'required|url|unique:companies,website',
        ];
    }

    public function messages()
    {
        return [
            'comp_logo.dimensions' => 'The company logo must be at least 100x100 pixels.',
        ];
    }
}
