<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait JsonValidatable
{
    /**
     * override用
     * エラー時のレスポンスを定義
     */
    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);

        throw new HttpResponseException($res);
    }
}