<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 13:16
 */

namespace YouTubeInfo\DataSource\Html\HtmlSource\Website\Connector;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use YouTubeInfo\ValueObject\Url;

class Guzzle implements AdapterInterface
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $httpMethod = 'GET';

    /**
     * @param array|null $guzzleOptions
     * @param string $httpMethod
     */
    public function __construct($guzzleOptions = [], $httpMethod = 'GET')
    {
        $defaultConfig = [
            'headers' => [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'pl,en-US;q=0.8,en;q=0.6',
                'Cache-Control' => 'max-age=0',
                'Connection' => 'keep-alive',
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36'
            ]
        ];
        $config = array_replace($defaultConfig, $guzzleOptions);
        $this->guzzleClient = new Client($config);
        $this->httpMethod = 'GET';
    }

    public function retrieve(Url $url): ResponseInterface
    {
        try {
            $response = $this->guzzleClient->request($this->httpMethod, (string)$url);
        } catch (RequestException $e) {
            $response = $e->getResponse();
        }

        return $response;
    }

}