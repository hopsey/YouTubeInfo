<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 20/11/16
 * Time: 14:54
 */

namespace YouTubeInfo;


use YouTubeInfo\DataSource\DataSourceInterface;
use YouTubeInfo\DataSource\Html;
use YouTubeInfo\DataSource\Html\HtmlSource\Website;
use YouTubeInfo\Entity\VideoEntity;
use YouTubeInfo\ValueObject\StringValue;
use YouTubeInfo\DataSource\Html\DomExtractor\ZendDomExtractorFactory;
use YouTubeInfo\ValueObject\YTUrlPattern;
use YouTubeInfo\DataSource\Html\HtmlSource\Website\Connector\AdapterInterface;

/**
 * Class YouTubeInfoService
 * @package YouTubeInfo
 */
class YouTubeInfoService
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * YouTubeInfoService constructor.
     * @param DataSourceInterface $dataSource
     */
    public function __construct(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * Zwraca zmapowaną encję
     * @param StringValue $videoId
     * @return VideoEntity
     */
    public function getVideoInfo(StringValue $videoId): VideoEntity
    {
        return $this->dataSource->getVideoInfo($videoId);
    }

    /**
     * Skrót/fabryka
     * @param AdapterInterface $connector
     * @param YTUrlPattern $url
     * @return static
     */
    public static function buildWebsiteService(AdapterInterface $connector, YTUrlPattern $url)
    {
        return new static(
            new Html(new Website(
                $connector, $url
            ), ZendDomExtractorFactory::build())
        );
    }
}