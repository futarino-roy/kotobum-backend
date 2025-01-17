<?php

return [
    'mode'                     => 'ja',
    'default_font_size'        => '12',
    'default_font'             => 'notosansjp',
    'shrink_tables_to_fit'     => 0, // 内容の縮小を無効にする
    'bleed_margin'             => 0, // 余白を完全に無効化
    'margin_left'              => 0,
    'margin_right'             => 0,
    'margin_top'               => 0,
    'margin_bottom'            => 0,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'Laravel mPDF',
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir'          => public_path('fonts/'),
    'custom_font_data'         => [ 'zenmarugothic' => [ 
                                        'R' => 'ZenMaruGothic-Regular.ttf',
                                        'Bl' => 'ZenMaruGothic-Black.ttf',
                                        'Bo' => 'ZenMaruGothic-Bold.ttf',
                                        'L' => 'ZenMaruGothic-Light.ttf',
                                        'M' => 'ZenMaruGothic-Medium.ttf',
                                    ],
                                    'leaguespartan' => [
                                        'R' => 'LeagueSpartan-Regular.ttf',
                                        'Bo' => 'LeagueSpartan-Bold.ttf',
                                        'SBo' => 'LeagueSpartan-SemiBold.ttf',
                                        'EBo' => 'LeagueSpartan-ExtraBold.ttf',
                                        'Bl' => 'LeagueSpartan-Black.ttf',
                                        'L' => 'LeagueSpartan-Light.ttf',
                                        'EL' => 'LeagueSpartan-ExtraLight.ttf',
                                        'M' => 'LeagueSpartan-Medium.ttf',
                                        'T' => 'LeagueSpartan-Thin.ttf'
                                    ],
                                    'notosansjp' => [
                                        'Bo' => 'NotoSansJP-Bold.ttf',
                                        'Bl' => 'NotoSansJP-Black.ttf',
                                    ],
                                  ],
    'auto_language_detection'  => false,
    'temp_dir'                 => storage_path('app'),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
    'BMPonly'                  => ['notosansjp']
];