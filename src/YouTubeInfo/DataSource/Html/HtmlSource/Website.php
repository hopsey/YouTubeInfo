<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 17:43
 */

namespace YouTubeInfo\DataSource\Html\HtmlSource;


use YouTubeInfo\DataSource\Html\HtmlSource\Website\Connector\AdapterInterface;
use YouTubeInfo\ValueObject\StringValue;
use YouTubeInfo\ValueObject\YTUrlPattern;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class Website implements HtmlSourceInterface, EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     * @var AdapterInterface
     */
    private $connector;

    /**
     * @var YTUrlPattern
     */
    private $urlPattern;

    /**
     * Website constructor.
     * @param AdapterInterface $connector
     */
    public function __construct(AdapterInterface $connector, YTUrlPattern $urlPattern)
    {
        $this->connector = $connector;
        $this->urlPattern = $urlPattern;
    }

    public function retrieveHtml(StringValue $videoId): StringValue
    {
        $response = $this->connector->retrieve($this->urlPattern->substitute($videoId));

        $this->getEventManager()->trigger("httpResponseReceived", $this, [
            'response' => $response
        ]);

        return StringValue::fromNative($response->getBody()->getContents());
    }
}