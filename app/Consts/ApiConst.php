<?php

namespace App\Consts;

define("LIFF_LINE_LOGIN_ID", config('line.liff_id'));

class ApiConst
{
    const LINE_BASE_URL = 'https://api.line.me';
    const LINE_OAUTH_URL = self::LINE_BASE_URL . "/oauth2/v2.1/verify";
    const LINE_PROFILE_URL = self::LINE_BASE_URL . "/v2/profile";
    const LINE_MESSAGE_PUSH_URL = self::LINE_BASE_URL . "/v2/bot/message/push";
    const LINE_MESSAGE_REPLY_URL = self::LINE_BASE_URL . "/v2/bot/message/reply";
    const LINE_MESSAGE_MULTI_URL = self::LINE_BASE_URL . "/v2/bot/message/multicast";
    const LINE_MESSAGE_PROFILE_URL = self::LINE_BASE_URL . "/v2/bot/profile/"; // 一番後ろにuserIdをくっつける
    const LINE_MESSAGE_FOLLOWERS_URL = self::LINE_BASE_URL . "/v2/bot/followers/ids"; // 認証済みアカウント(本番公式LINE)でのみ使用可

    const LIFF_BASE_URL = "https://liff.line.me";
    const LIFF_LINE_LOGIN_ID = LIFF_LINE_LOGIN_ID;
    const LIFF_INVITE_URL = self::LIFF_BASE_URL . "/" . self::LIFF_LINE_LOGIN_ID . "/invite";

    // LIFFのURL
    const LIFF_CALENDER_URL = self::LIFF_BASE_URL . "/" . self::LIFF_LINE_LOGIN_ID . "/calendar";
}
