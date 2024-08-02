<?php

namespace App\Traits\Requests;

Trait RequestPraramMakable
{
    /**
     * パラメータがnullの場合に0にして返す
     * @param $request リクエストパラメータの配列
     * @param $key_names 値がnullのときに、0をセットしたいパラメータの名前
     */
    public function nullToZero(array $key_names): array
    {
        $params = $this->safe()->all();
        foreach($key_names as $key) {
            if(!array_key_exists($key, $params) || is_null($params[$key]) ) {
                $params[$key] = 0;
            }
        }

        return $params;
    }
}