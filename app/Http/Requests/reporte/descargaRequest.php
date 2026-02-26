<?php

namespace App\Http\Requests\reporte;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class descargaRequest extends FormRequest
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
            'marca.*' => 'integer',
            'categoria.*' => 'integer',
            'f_inicio' => 'date',
            'f_fin' => 'date',
            'marca' => 'array',
            'categoria' => 'array',
        ];
    }
        public function messages()
    {
        return [
            'integer' => 'The :attribute must be a integer',
            'array' => 'The :attribute must be a array',
            'date' => 'The :attribute must be a valid date',
        ];
    }
    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }
}
