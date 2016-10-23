<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 16:42
 */

namespace YouTubeInfo\DataSource\Website\DomExtractor;


use YouTubeInfo\ValueObject\StringValue;
use Zend\Dom\Document;
use Zend\Dom\Document\Query;
use Zend\EventManager\EventManagerAwareTrait;

class ZendDomExtractor implements ExtractorInterface
{
    /**
     * @var string[]
     */
    private $extractValues = [];

    /**
     * @var Document
     */
    private $dom;

    /**
     * @param $name
     * @param $cssPath
     * @param \Closure $extract
     */
    public function registerExtractValue($name, $cssPath, \Closure $extract)
    {
        $this->extractValues[$name] = ['path' => $cssPath, 'extract' => $extract];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function extract($name)
    {
        if (!isset($this->extractValues[$name])) {
            throw new \InvalidArgumentException("Not found value " . $name);
        }

        $node = Query::execute($this->extractValues[$name]['path'], $this->dom, Query::TYPE_CSS);
        if (count($node) == 0) {
            throw new ElementNotFoundException($this->dom, $this->extractValues[$name]['path']);
        }

        return $this->extractValues[$name]['extract']($node);
    }

    /**
     * @param StringValue $dom
     */
    public function setDom(StringValue $dom)
    {
        $this->dom = new Document((string)$dom);
    }


}