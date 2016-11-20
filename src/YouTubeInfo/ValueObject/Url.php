<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 27/08/16
 * Time: 14:02
 */

namespace YouTubeInfo\ValueObject;

use StdDomain\ValueObject\InvalidNativeArgumentException;
use StdDomain\ValueObject\ValueObjectInterface;
use StdDomain\ValueObject\ValueObjectTrait;
use Zend\Validator\StaticValidator;
use Zend\Validator\Uri;

class Url implements ValueObjectInterface
{
    const ERR_INVALID_URL = 'invalidUrl';

    use ValueObjectTrait;

    public function __construct($url)
    {
        /** @var Uri $validator */
        $validator = StaticValidator::getPluginManager()->get('Uri');

        if (!$validator->isValid($url)) {
            throw new InvalidNativeArgumentException(implode(", ", $validator->getMessages()), self::ERR_INVALID_URL);
        }

        $this->value = $url;
    }

}