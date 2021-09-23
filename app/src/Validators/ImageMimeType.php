<?php


namespace Kliker02\VcruTask\Validators;

/**
 * @author Alex Tokunov
 * Validating incoming mime-type string on relation to image mime-type
 * Class ImageMimeType
 * @package Kliker02\VcruTask\Validators
 */
class ImageMimeType implements ValidatorInterface
{
    protected $customType = '';

    private $allowsTypes = [
        'image/png',
        'image/jpeg',
        'image/gif',
        'image/bmp',
        'image/vnd.microsoft.icon',
        'image/tiff',
        'image/svg+xml'
    ];

    public function __construct($type)
    {
        $this->customType = $type;
    }

    public function isValid()
    {
        return in_array($this->customType, $this->allowsTypes);
    }
}