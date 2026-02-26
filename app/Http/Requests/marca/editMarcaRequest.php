<?php

namespace App\Http\Requests\marca;

use App\Rules\Base64Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class editMarcaRequest extends FormRequest
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
            'rs'=> 'required|string',
            'tel'=> 'required|numeric',
            'contacto'=> 'required|string',
            'mail_contacto'=> 'required|email:rfc,dns',
            'url'=> 'required|url',
            'restric'=> 'string',
            'llam_cal' => 'required|boolean',
            'vis_cal' => 'required|boolean',
            'contrato_base64'=> 'required|string|regex:~^data:application/pdf;base64,~',
            'imagen_base64'=> ['required', new Base64Image],
            'logo_base64'=> ['required', new Base64Image],
            "categoria" => "required|array",
            "categoria.*" => "numeric",
            "estatus" => "required|numeric"
        ];
    }
        public function messages()
    {
        return [
            'required' => 'The :attribute is required',
            'numeric' => 'The :attribute must be a numeric',
            'array' => 'The :attribute must be an array',
            'string' => 'The :attribute must be a string',
            'email' => 'The :attribute must be a email',
            'url' => 'The :attribute must be a valid url',
            'boolean' => 'The :attribute must be a boolean',
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
