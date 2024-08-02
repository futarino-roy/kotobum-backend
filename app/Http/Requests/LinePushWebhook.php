<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class LinePushWebhook extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $channelSecret = config("line.channel_secret");
        $httpRequestBody = $this->getContent();
        $hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
        $signature = base64_encode($hash);
        $x_line_signature = $this->headers->get("x-line-signature");

        if(config('app.debug')){
            Log::debug("x-line: ".$x_line_signature);
            Log::debug("\n");
            Log::debug("sig: ".$signature);
        }

        //不正リクエスト
        // if($signature !== $x_line_signature) return response()->json("{}");
        return $signature === $x_line_signature;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            //
        ];
    }
}
