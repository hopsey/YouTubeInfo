<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 17:43
 */

namespace YouTubeInfo\DataSource;


use YouTubeInfo\DataSource\Website\Connector\AdapterInterface;
use YouTubeInfo\DataSource\Website\DomExtractor\ElementNotFoundException;
use YouTubeInfo\DataSource\Website\DomExtractor\ExtractorInterface;
use YouTubeInfo\Hydrator\StaticHydrator;
use YouTubeInfo\Hydrator\ValueObject;
use YouTubeInfo\ValueObject\StringValue;
use YouTubeInfo\VideoEntity;

class Website implements DataSourceInterface
{
    /**
     * @var AdapterInterface
     */
    private $connector;

    /**
     * @var ExtractorInterface
     */
    private $domExtractor;

    /**
     * Website constructor.
     * @param AdapterInterface $connector
     * @param ExtractorInterface $domExtractor
     */
    public function __construct(AdapterInterface $connector, ExtractorInterface $domExtractor)
    {
        $this->connector = $connector;
        $this->domExtractor = $domExtractor;
    }

    /**
     * @param StringValue $ytVideoId
     * @return VideoEntity
     */
    public function getVideoInfo(StringValue $ytVideoId): VideoEntity
    {
        $dom = $this->connector->retrieve($ytVideoId);
        $this->domExtractor->setDom($dom);
        $properties = ValueObject::getVOProperties(VideoEntity::class);
        $invokeArgs = [
            'id' => $ytVideoId,
            'comments' => 4
        ];
        foreach ($properties as $property) {
            if (array_key_exists($property, $invokeArgs)) {
                continue;
            }
            try {
                $invokeArgs[$property] = $this->domExtractor->extract($property);
            } catch (ElementNotFoundException $e) {
                var_dump($e->getCssPath());
            }
        }
        return StaticHydrator::build(ValueObject::class, VideoEntity::class, $invokeArgs);
    }
}