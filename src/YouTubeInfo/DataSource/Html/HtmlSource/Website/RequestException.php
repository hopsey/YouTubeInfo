<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 20/11/16
 * Time: 14:17
 */

namespace YouTubeInfo\DataSource\Website;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends \RuntimeException
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * RequestException constructor.
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct($message, RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
        parent::__construct($message);
    }
}