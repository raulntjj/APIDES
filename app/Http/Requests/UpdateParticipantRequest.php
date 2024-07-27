<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParticipantRequest extends FormRequest{
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
            //For participant table
            'user_id' => ['required'],
            'team_id' => ['required'],
            'institution_id' => ['nullable'],
            'modality_id' => ['required'],
            'position' => ['nullable'],
        ];
    }
}
