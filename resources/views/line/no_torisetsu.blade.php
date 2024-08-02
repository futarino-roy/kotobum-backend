{
    "replyToken": "{{ $replyToken }}",
    "messages": [
        {
            "type": "template",
            "altText": "画像の取得に失敗しました。",
            "template": {
                "type": "confirm",
                "text": "画像の取得に失敗しました。トリセツの画像が作成されるまで時間がかかる場合があります。もう一度問い合わせますか？",
                "actions": [
                    {
                        "type": "message",
                        "label": "はい",
                        "text": "トリセツの入力を完了しました"
                    },
                    {
                        "type": "uri",
                        "label": "初めから作る",
                        "uri": "https://liff.line.me/{{ config('line.liff_id') }}/torisetsu_create/"
                    }
                ]
            }
        }
    ]
}
