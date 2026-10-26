<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'persona' => ['required', 'uuid', 'exists:persone,id'],
            'icona_id' => ['nullable', 'uuid', 'exists:icone,id'],
            'descrizione' => ['required', 'string'],
            'start' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'icona_id.exists' => 'L’icona selezionata non è disponibile.',
        ];
    }
}
