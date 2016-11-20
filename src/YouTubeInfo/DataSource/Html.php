<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 20/11/16
 * Time: 15:00
 */

namespace YouTubeInfo\DataSource;

use StdDomain\Entity\EntityFactory;
use StdDomain\Reflection\ReflectionManager;
use StdDomain\ValueObject\Factory\ValueObjectBuilderError;
use YouTubeInfo\DataSource\Html\DomExtractor\ExtractorInterface;
use YouTubeInfo\DataSource\Html\ElementNotFoundException;
use YouTubeInfo\DataSource\Html\EntityBuildFailedException;
use YouTubeInfo\DataSource\Html\HtmlSource\HtmlSourceInterface;
use YouTubeInfo\Entity\VideoEntity;
use YouTubeInfo\ValueObject\StringValue;

class Html implements DataSourceInterface
{
    /**
     * @var HtmlSourceInterface
     */
    private $htmlSource;

    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * Html constructor.
     * @param HtmlSourceInterface $htmlSource
     * @param ExtractorInterface $extractor
     */
    public function __construct(HtmlSourceInterface $htmlSource, ExtractorInterface $extractor)
    {
        $this->htmlSource = $htmlSource;
        $this->extractor = $extractor;
    }

    public function getVideoInfo(StringValue $ytVideoId): VideoEntity
    {
        $html = $this->htmlSource->retrieveHtml($ytVideoId);

        $this->extractor->setDom($html);
        $properties = ReflectionManager::getReflectedProperties(VideoEntity::class);

        $extractArray = [];

        foreach ($properties as $property) {
            $name = $property->getName();
            $extractArray[] = $name;
        }

        $invokeArgs = [
            'id' => $ytVideoId,
            'comments' => 4
        ];
        $notFoundElements = [];
        foreach ($extractArray as $property) {
            if (array_key_exists($property, $invokeArgs)) {
                continue;
            }
            try {
                $invokeArgs[$property] = $this->extractor->extract($property);
            } catch (ElementNotFoundException $e) {
                $notFoundElements[] = $e->getCssPath();
            }
        }
        $error = new ValueObjectBuilderError();
        $entity = EntityFactory::build(VideoEntity::class, $invokeArgs, $error);

        if ($entity === false) {
            throw new EntityBuildFailedException("Entity build failed", $html, $invokeArgs, $notFoundElements);
        }

        return $entity;
    }

}