<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepenseStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'vehicule_id' => ['required', 'integer', 'exists:vehicules,id'],
            'piece' => ['required', 'string'],
            'type' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
