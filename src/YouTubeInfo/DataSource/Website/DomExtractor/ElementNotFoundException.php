<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 22:27
 */

namespace YouTubeInfo\DataSource\Website\DomExtractor;


use Zend\Dom\Document;

class ElementNotFoundException extends \RuntimeException
{
    /**
     * @var string $cssPath
     */
    private $cssPath;

    /**
     * @var Document $dom
     */
    private $dom;

    public function __construct(Document $dom, $cssPath)
    {
        $this->dom = $dom;
        $this->cssPath = $cssPath;

        parent::__construct("Element not found (path " . $cssPath . ")");
    }

    public function getCssPath()
    {
        return $this->cssPath;
    }
}