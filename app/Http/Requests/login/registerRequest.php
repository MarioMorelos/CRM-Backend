<?php

namespace App\Http\Requests\login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registerRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            // 'password' => 'required|string|min:8',
            'id_grupo' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'id_rol' => 'required|integer',
            // 'fecha_ultimo_acceso' => 'required|date',
            // 'activo' => 'required|boolean',
            // 'pass_default' => 'required|boolean',
            // 'token' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 255 characters',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be less than 255 characters',
            'email.unique' => 'Email already exists',
            // 'password.string' => 'Password must be a string',
            // 'password.min' => 'Password must be at least 8 characters',
            // 'password.confirmed' => 'Password confirmation does not match',
            'id_grupo.integer' => 'id_grupo must be an integer',
            'nombre.string' => 'Nombre must be a string',
            'nombre.max' => 'Nombre must be less than 255 characters',
            'apellidos.string' => 'Apellidos must be a string',
            'apellidos.max' => 'Apellidos must be less than 255 characters',
            'id_rol' => 'id_rol must be an integer',
            // 'fecha_ultimo_acceso' => 'fecha_ultimo_acceso must be a date',
            // 'fecha_ultimo_acceso.required' => 'fecha_ultimo_acceso is required',
            // 'activo' => 'activo must be a boolean',
            // 'pass_default' => 'pass_default must be a boolean',
            // 'token' => 'token must be a string',
            // 'token.max' => 'token must be less than 255 characters',
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
