{
    "to": "{{$admin->line_user_id}}",
    "messages": [
        {
            "type": "flex",
            "altText": "送信が成功しました。。",
            "contents":
            {
                "type": "bubble",
                "body": {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                        {
                            "type": "text",
                            "wrap": true,
                            "text": "{{ $user->line_display_name }}さんに送信を成功しました。",
                            "color": "#000000"
                        }
                    ],
                    "paddingAll": "20px"
                }
            }
        }
    ]
}
