<?php

namespace App\Http\Requests;

use App\Helpers\EmailValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContribuyenteRequest extends FormRequest
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
        $rules = [
            'tipo_documento' => ['required', 'string', 'in:CC,NIT'],
            'documento'      => ['required', 'string', 'max:255'],
            'nombres'        => ['required', 'string', 'max:255'],
            'apellidos'      => ['nullable', 'string', 'max:255'],
            'direccion'      => ['nullable', 'string', 'max:255'],
            'telefono'       => ['nullable', 'string', 'max:30'],
            'celular'        => ['nullable', 'string', 'max:30'],
            'email'          => ['required', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    if (!EmailValidator::isValid($value)) {
                        $fail('El correo electrónico tiene un formato inválido.');
                    }
                }],
            'usuario' => ['required', 'string', 'max:255'],
        ];

        // Validación para crear (POST)
        if ($this->isMethod('post')) {
            $rules['documento'][] = Rule::unique('contribuyentes', 'documento');
        }

        // Validación para actualizar (PUT/PATCH)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($this->route('contribuyente') !== null) {
                $contribuyenteId      = $this->route('contribuyente');
                $rules['documento'][] = Rule::unique('contribuyentes', 'documento')->ignore($contribuyenteId);
            }
        }

        return $rules;
    }

    /**
     * Get the custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'tipo_documento.required' => 'El campo :attribute es obligatorio.',
            'tipo_documento.in'       => 'El valor del campo :attribute debe ser CC o NIT.',
            'documento.required'      => 'El campo :attribute es obligatorio.',
            'documento.unique'        => 'El :attribute ya está registrado.',
            'nombres.required'        => 'El campo :attribute es obligatorio.',
            'nombres.max'             => 'El campo :attribute no debe exceder 255 caracteres.',
            'email.required'          => 'El campo :attribute es obligatorio.',
            'email.email'             => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'usuario.required'        => 'El campo :attribute es obligatorio.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $data = $this->all();

        if ($data['tipo_documento'] === 'NIT') {
            // Asignar la razón social a "nombres" y "apellidos"
            // Si es NIT, dividir los nombres y apellidos según el espacio
            $nombreSurnames = explode(' ', $data['razon_social']);

            if (count($nombreSurnames) > 1) {
                // Primer parte como nombre y el resto como apellidos
                $this->merge([
                    'nombres'   => array_shift($nombreSurnames),
                    'apellidos' => implode(' ', $nombreSurnames) ?? '',
                ]);
            }
        }
    }
}
