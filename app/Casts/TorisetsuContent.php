<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class TorisetsuContent implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }

    /**
     * 配列として受け取ったトリセツの内容を箇条書きかつ値ごとに改行を入れて文字列としてDBに保存する
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $string = "";
        foreach ($value as $index => $tag) {
            if ($index === array_key_last($value)) {
                $string = "{$string}・{$tag}";
            } else {
                $string = "{$string}・{$tag}\n";
            }
        }

        return $string;
    }
}
