<?php

require_once 'vendor/autoload.php';

$service = \YouTubeInfo\YouTubeInfoService::buildWebsiteService(
    new \YouTubeInfo\DataSource\Html\HtmlSource\Website\Connector\Guzzle(),
    \YouTubeInfo\ValueObject\YTUrlPattern::fromNative(
        'https://www.youtube.com/atch?v=' . \YouTubeInfo\ValueObject\YTUrlPattern::YTID_TAG
    )
);

try {
    $entity = $service->getVideoInfo(\YouTubeInfo\ValueObject\StringValue::fromNative('Mg6tAki0N0g'));
} catch (\YouTubeInfo\DataSource\Html\EntityBuildFailedException $e) {
    var_dump($e);
}
var_dump($entity);