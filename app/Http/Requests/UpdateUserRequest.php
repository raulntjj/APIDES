<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool{
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*
            Request definido apenas como campos obrigatórios por enquanto.
        */
        return [
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'birthday' => ['required'],
            'group' => ['nullable'],
            'interfaceLanguage' => ['nullable'],
            'photo' => ['nullable']
        ];
    }
}
