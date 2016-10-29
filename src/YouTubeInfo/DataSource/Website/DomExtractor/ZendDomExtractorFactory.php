<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 24/10/16
 * Time: 21:25
 */

namespace YouTubeInfo\DataSource\Website\DomExtractor;


use Zend\Dom\Document\NodeList;

final class ZendDomExtractorFactory
{
    public static function build(): ZendDomExtractor
    {
        $extractor = new ZendDomExtractor();

        // channelId
        $extractor->registerExtractValue('channelId', 'meta[itemprop="channelId"]', function (NodeList $dom) {
            return $dom->current()->getAttribute('content');
        });

        // title
        $extractor->registerExtractValue('title', 'meta[itemprop="name"]', function (NodeList $dom) {
            return $dom->current()->getAttribute('content');
        });

        // views
        $extractor->registerExtractValue('views', 'div.watch-view-count', function (NodeList $dom) {
            return (int)filter_var($dom->current()->nodeValue, FILTER_SANITIZE_NUMBER_INT);
        });

        // likes
        $extractor->registerExtractValue('likes', 'button.like-button-renderer-like-button span', function (NodeList $dom) {
            return (int)$dom->current()->nodeValue;
        });

        // dislikes
        $extractor->registerExtractValue('dislikes', 'button.like-button-renderer-dislike-button span', function (NodeList $dom) {
            return (int)$dom->current()->nodeValue;
        });

        // publishDate
        $extractor->registerExtractValue('publishDate', 'strong.watch-time-text', function (NodeList $dom) {
            return date("Y-m-d", strtotime(preg_replace("/[^0-9\.]/", '', $dom->current()->nodeValue)));
        });

        // description
        $extractor->registerExtractValue('description', 'meta[itemprop="description"]', function (NodeList $dom) {
            return $dom->current()->getAttribute('content');
        });

        // duration
        $extractor->registerExtractValue('duration', 'meta[itemprop="duration"]', function (NodeList $dom) {
            return $dom->current()->getAttribute('content');
        });

        return $extractor;
    }
}