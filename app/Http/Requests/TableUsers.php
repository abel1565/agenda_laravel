<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|unique|max:255',
            'phone' => 'required|string|max:255',
            'status_id' => 'required|integer',
            'rol_id' => 'required|integer',
        
        ];
    }
}
