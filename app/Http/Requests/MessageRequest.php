<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class MessageRequest extends FormRequest
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
        $validate_future = function ($attribute, $value, $fail) {
            if (!Carbon::parse($value)->isFuture()) {
                $fail('過去には設定できません');
            }
        };
        return [
            'content' => 'required',
            'send_at' => [
                'required',
                $validate_future
            ],
            'audio_url' => 'nullable|url'
        ];
    }
}
