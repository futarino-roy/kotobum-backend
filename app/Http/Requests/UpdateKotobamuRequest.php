<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Log;

class UpdateKotobamuRequest extends FormRequest
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
            'is_open' => 'nullable|numeric|between:0,1',
            'keyword' => ['nullable', Rule::unique('kotobamus')->ignore($this->kotobamu->id)],
            'done_on' => 'nullable|date'
        ];
    }
}
