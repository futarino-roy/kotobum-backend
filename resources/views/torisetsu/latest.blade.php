<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link href="{{ asset('css/optimize.css') }}" rel="stylesheet">
</head>

<body>
    <div class="sheet">
        <div class="torisetsu">
            <div class="up">
                <div class="up__title">
                    <img class="up__title-img" src="/images/title.png">
                </div>
                <div class="up__main">
                    <div class="up__main_top">
                        <div class="up__main_top-sub_title">
                            FUTARINO TORISETSU
                        </div>
                        <div class="up__main_top-date">
                            {{ $date }}
                        </div>
                    </div>
                    <div class="up__main_name">
                        <p>{{ strtoupper($latest_torisetsu->name) }}</p>
                        <div class="up__main_name-img">
                            <img src="/images/gear.png">
                        </div>
                    </div>
                    <div class="up__main_content">
                        <div class="up__main_content-good_at">
                            <h2><img src="/icons/thumb-up.png">
                                <div>得意なこと</div>
                            </h2>
                            <p>
                                <span class="good_at_content">{!! nl2br(e($latest_torisetsu->good_at)) !!}</span>
                            </p>
                        </div>
                        <div class="up__main_content-weak_point">
                            <h2><img src="/icons/water.png">
                                <div>苦手なこと</div>
                            </h2>
                            <p>
                                <span class="weak_point_content">{!! nl2br(e($latest_torisetsu->weak_point)) !!}</span>
                            </p>
                        </div>
                        <div class="up__main_content-good">
                            <h2><img src="/icons/charge.png">
                                <div>充電方式<br><span>(以下の行為によって気持ちが向上します)</span></div>
                            </h2>
                            <p>
                                <span class="good_content">{!! nl2br(e($latest_torisetsu->recommendation)) !!}</span>
                            </p>
                        </div>
                        <div class="up__main_content-bad">
                            <h2><img src="/icons/waremono.png">
                                <div>安全上のご注意<br><span>(以下の行為は破損につながる恐れがあります)</span></div>
                            </h2>
                            <p>
                                <span class="bad_content">{!! nl2br(e($latest_torisetsu->landmine)) !!}</span>
                            </p>
                        </div>
                        @if ($latest_torisetsu->illust_choice)
                        <img src="/images/human-{{ $latest_torisetsu->illust_choice }}.png" class="up__main_content-human_icon">
                        @endif
                    </div>
                </div>
            </div>
            <div class="down">
                <div class="down__title">
                    状況別対処法
                </div>
                <div class="down__content">
                    <div class="down__content-icon">
                        <img src="/images/warning.png">
                    </div>
                    <div class="down__content-more">
                        @if (zero_content_by_situation($latest_torisetsu->id))
                        <p class="down__content-more_zero">個別状況につきましては、直接お問い合わせください</p>
                        @else
                        <div class="down__content-more_list">
                            <!-- 状況名と入力内容を分ける縦線(他に方法あればリファクタしてください) -->
                            <div class="vertical-separator"></div>

                            @if ($latest_torisetsu->when_depressed)
                            <div class="down__content-more_item when_depressed">
                                <div class="scene">落ち込んでいる時</div>
                                <p class="input">{!! nl2br(e($latest_torisetsu->when_depressed)) !!}</p>
                            </div>
                            @endif
                            @if ($latest_torisetsu->when_sick)
                            <div class="down__content-more_item when_sick">
                                <div class="scene">体調不良の時</div>
                                <p class="input">{!! nl2br(e($latest_torisetsu->when_sick)) !!}</p>
                            </div>
                            @endif
                            @if ($latest_torisetsu->for_making_up)
                            <div class="down__content-more_item for_making_up">
                                <div class="scene">仲直りしたいとき</div>
                                <p class="input">{!! nl2br(e($latest_torisetsu->for_making_up)) !!}</p>
                            </div>
                            @endif
                            @if ($latest_torisetsu->when_bad_mood)
                            <div class="down__content-more_item when_bad_mood">
                                <div class="scene">不機嫌な時</div>
                                <p class="input">{!! nl2br(e($latest_torisetsu->when_bad_mood)) !!}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="note">
            ※返品交換できかねますのでご了承ください
        </div>
    </div>
</body>

</html>
