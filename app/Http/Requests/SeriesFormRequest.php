<?php

namespace Meri\NameApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Pode ser criada com o comando `php artisan make:request SeriesFormRequest`
class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'nome' => ['required', 'min:2'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo :attribute precisa de pelo menos :min caracteres',
        ];
    }
}
