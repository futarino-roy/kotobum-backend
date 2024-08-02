{
    "to": "{{$user->line_user_id}}",
    "messages": [
        {
            "type": "flex",
            "altText": "コトバムメッセージをお届けします！",
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
                            "text": "{{ nl2string_nl($message_content) }}"
                        }
                    ],
                    "paddingAll": "15px"
                }
            }
        }
        @if ($image_url)
        ,{
            "type": "image",
            "originalContentUrl": "{{ $image_url }}",
            "previewImageUrl": "{{ $image_url }}"
        }
        @endif
        @if ($audio_url)
        ,{
            "type": "flex",
            "altText": "メッセージが届きました！",
            "contents":
            {
                "type": "bubble",
                "header": {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                        {
                            "type": "text",
                            "text": "メッセージが届きました！",
                            "color": "#000000",
                            "weight": "bold",
                            "size": "md",
                            "contents": []
                        },
                        {
                            "type": "separator",
                            "margin": "5px",
                            "color": "#252525"
                        }
                    ],
                    "justifyContent": "center",
                    "alignItems": "center",
                    "paddingTop": "20px",
                    "paddingAll": "10px"
                },
                "body": {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                        {
                            "type": "text",
                            "text": "あなたへの音声メッセージが届いています💬✨\n今すぐ聴いてみましょう！",
                            "wrap": true,
                            "size": "md"
                        },
                        {
                            "type": "button",
                            "action": {
                                "type": "uri",
                                "label": "▶メッセージを再生",
                                "uri": "{{ $audio_url }}"
                            }
                        }
                    ],
                    "paddingBottom": "0px",
                    "paddingTop": "0px"
                },
                "styles": {
                    "header": {
                        "backgroundColor": "#ffffff"
                    }
                }
            }
        }
        @endif
    ]
}
