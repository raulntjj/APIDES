<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcriterionRequest extends FormRequest{
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
            'criterion_id' => ['required'],
            'name' => ['required'],
            'points' => ['nullable'],
        ];
    }
}
