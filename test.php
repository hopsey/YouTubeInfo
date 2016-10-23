<?php

require_once 'vendor/autoload.php';

$extractor = new \YouTubeInfo\DataSource\Website\DomExtractor\ZendDomExtractor();
$extractor->registerExtractValue('channelId', 'meta[itemprop="channelId"]', function (\Zend\Dom\Document\NodeList $dom) {
    return $dom->current()->getAttribute('content');
});

$extractor->registerExtractValue('views', 'div.watch-view-count', function (\Zend\Dom\Document\NodeList $dom) {
    return (int)filter_var($dom->current()->nodeValue, FILTER_SANITIZE_NUMBER_INT);
});

//$extractor->registerExtractValue('comments', 'div.like-button-renderer-like-button', function (\Zend\Dom\Document\NodeList $dom) {
//    return $dom->getAttribute('content');
//});

$extractor->registerExtractValue('likes', 'button.like-button-renderer-like-button span', function (\Zend\Dom\Document\NodeList $dom) {
    return (int)$dom->current()->nodeValue;
});

$extractor->registerExtractValue('dislikes', 'button.like-button-renderer-dislike-button span', function (\Zend\Dom\Document\NodeList $dom) {
    return (int)$dom->current()->nodeValue;
});

$extractor->registerExtractValue('publishDate', 'strong.watch-time-text', function (\Zend\Dom\Document\NodeList $dom) {
    return date("Y-m-d", strtotime(preg_replace("/[^0-9\.]/", '', $dom->current()->nodeValue)));
});

$extractor->registerExtractValue('description', 'p#eow-description', function (\Zend\Dom\Document\NodeList $dom) {
    return strip_tags($dom->current()->nodeValue);
});

$extractor->registerExtractValue('duration', 'meta[itemprop="duration"]', function (\Zend\Dom\Document\NodeList $dom) {
    return $dom->current()->getAttribute('content');
});

$dataSource = new \YouTubeInfo\DataSource\Website(
    new \YouTubeInfo\DataSource\Website\Connector\Guzzle(
        \YouTubeInfo\ValueObject\YTUrlPattern::fromNative('https://www.youtube.com/watch?v=' . \YouTubeInfo\ValueObject\YTUrlPattern::YTID_TAG)
    ),
    $extractor
);

$entity = $dataSource->getVideoInfo(\YouTubeInfo\ValueObject\StringValue::fromNative('Mg6tAki0N0g'));
var_dump($entity);