<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 13:15
 */

namespace YouTubeInfo\DataSource\Html\HtmlSource\Website\Connector;


use Psr\Http\Message\ResponseInterface;
use YouTubeInfo\ValueObject\StringValue;
use YouTubeInfo\ValueObject\Url;

interface AdapterInterface
{
    /**
     * Zwraca odpowiedz serwera zgodnie z PSR-7
     * @param Url $url
     * @return ResponseInterface
     */
    public function retrieve(Url $url): ResponseInterface;
}