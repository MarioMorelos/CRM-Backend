<?php

namespace App\Http\Requests\sucursal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class sucursalRequest extends FormRequest
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
            'id' => 'required|integer',
            'nombre' => 'required|string',
            'tel' => 'required|string',
            'calle' => 'required|string',
            'num_ext' => 'required|string',
            'num_int' => 'nullable|string',
            'referencia' => 'nullable|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'cp' => 'required|string',
            'id_zona' => 'required|integer',
        ];
    }
        public function messages()
    {
        return [
            'required' => 'The :attribute is required',
            'integer' => 'The :attribute must be a integer',
            'string' => 'The :attribute must be a string',
            'numeric' => 'The :attribute must be a numeric value',
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
