<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Debe retornar true, a menos que tenga alguna validacion de middleware o de permisos para denegarla
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|min:1',
            'stock' => 'required|min:0',
            'status' => 'required|in:available,unavailable',
        ];
    }

    // Añadiendo validaciones personalizadas
    public function withValidator($validator)
    {
        // Recibe una funcion anonima, donde ejecutara la validacion adicional
        $validator->after(function ($validator) {

            // ya no es el request sino pasa a ser el this, al estar dentro de la misma clase del Form Request
            if ($this->input('status') === 'available' && $this->input('stock') == 0) {

                // No se pone el redirect, ya que automaticamente si se puseha un error a la variable global, este sera redireccionado y enviando como withErros a la vista
                $validator->errors()->add('stock', 'If available must have stock');
            }

        });
    }
}
