<?php

namespace App\Http\Requests;

use App\Traits\JsonValidatable;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    use JsonValidatable;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,15',
            'gender' => 'required|numeric|between:1,3',
            'state' => 'required||numeric|between:1,4',
            'pref' => 'nullable|numeric|between:1,47',
            'birthday' => 'required|date',
            'accept' => 'accepted|required',
        ];
    }
}
