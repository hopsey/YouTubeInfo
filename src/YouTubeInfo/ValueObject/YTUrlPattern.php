<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 13:58
 */

namespace YouTubeInfo\ValueObject;


class YTUrlPattern extends Url
{
    const ERR_INVALID_YT_PATTERN = 'InvalidYtPattern';
    const YTID_TAG = '[YTVideoId]';

    public function __construct($url)
    {
        if (!preg_match('/' . preg_quote(self::YTID_TAG) . '/', (string)$url)) {
            throw new InvalidNativeArgumentException("URL does not include " . self::YTID_TAG, self::ERR_INVALID_URL);
        }
        parent::__construct($url);
    }

    public function substitute(StringValue $videoId)
    {
        return Url::fromNative(str_replace(self::YTID_TAG, $videoId->toNative(), $this->value));
    }
}