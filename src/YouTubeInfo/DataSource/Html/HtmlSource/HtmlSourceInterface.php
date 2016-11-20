<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 20/11/16
 * Time: 15:01
 */

namespace YouTubeInfo\DataSource\Html\HtmlSource;

use YouTubeInfo\ValueObject\StringValue;

/**
 * Interface HtmlSourceInterface
 * @package YouTubeInfo\DataSource\Html
 */
interface HtmlSourceInterface
{
    /**
     * Zwraca HTML dla zadanego VideoID
     * @param StringValue $videoId
     * @return StringValue
     */
    public function retrieveHtml(StringValue $videoId): StringValue;
}