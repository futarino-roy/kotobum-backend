{
    "to": "{{$admin->line_user_id}}",
    "messages": [
        {
            "type": "flex",
            "altText": "送信が失敗しました。",
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
                            "text": "{{ $user->line_display_name }}さんに送信を失敗しました。",
                            "color": "#FF0000"
                        }
                    ],
                    "paddingAll": "20px"
                }
            }
        }
    ]
}
