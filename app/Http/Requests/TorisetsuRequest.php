<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TorisetsuRequest extends FormRequest
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
            'name' => 'required|string|max:10',
            'good_at' => 'required|array',
            'good_at.*' => 'string',
            'weak_point' => 'required|array',
            'weak_point.*' => 'string',
            'recommendation' => 'required|array',
            'recommendation.*' => 'string',
            'landmine' => 'required|array',
            'landmine.*' => 'string',
            'when_depressed' => 'nullable|array',
            'when_depressed.*' => 'string',
            'when_sick' => 'nullable|array',
            'when_sick.*' => 'string',
            'for_making_up' => 'nullable|array',
            'for_making_up.*' => 'string',
            'when_bad_mood' => 'nullable|array',
            'when_bad_mood.*' => 'string',
            'illust_choice' => 'nullable|between:1,4'
        ];
    }
}
