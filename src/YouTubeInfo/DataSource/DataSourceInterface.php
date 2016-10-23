<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 17:45
 */

namespace YouTubeInfo\DataSource;


use YouTubeInfo\ValueObject\StringValue;
use YouTubeInfo\VideoEntity;

interface DataSourceInterface
{
    /**
     * @param StringValue $ytVideoId
     * @return VideoEntity
     */
    public function getVideoInfo(StringValue $ytVideoId): VideoEntity;
}