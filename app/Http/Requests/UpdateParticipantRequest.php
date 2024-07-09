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
            'user_id',
            'firstName',
            'lastName',
            'gender',
            'position',
            'photo',
            'team_id',
            'institution_id',
            'modality_id' => ['required']
        ];
    }
}
