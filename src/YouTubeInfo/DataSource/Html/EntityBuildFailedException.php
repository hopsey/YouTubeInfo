<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 20/11/16
 * Time: 15:42
 */

namespace YouTubeInfo\DataSource\Html;


class EntityBuildFailedException extends \Exception
{

    /**
     * @var string
     */
    private $html;

    /**
     * @var string[]
     */
    private $invokeArgs;

    /**
     * @var string[]
     */
    private $notFoundFields;

    /**
     * EntityBuildFailedException constructor.
     * @param string $html
     * @param \string[] $invokeArgs
     * @param \string[] $notFoundFields
     */
    public function __construct($message, $html, array $invokeArgs, array $notFoundFields)
    {
        $this->html = $html;
        $this->invokeArgs = $invokeArgs;
        $this->notFoundFields = $notFoundFields;
        parent::__construct($message);
    }


}