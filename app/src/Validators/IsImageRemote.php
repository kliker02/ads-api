<?php


namespace Kliker02\VcruTask\Validators;

/**
 * @author Alex Tokunov
 * Validating image on remote server by content-type
 * Class IsImageRemote
 * @package Kliker02\VcruTask\Validators
 */
class IsImageRemote implements ValidatorInterface
{
    protected $url = '';


    public function __construct($url)
    {
        $this->url = $url;
    }

    public function isValid()
    {
        $headers = get_headers($this->url);
        $ContentType = '';
        if (is_array($headers)) foreach ($headers as $str) {
            if (preg_match('/content-type: .+/', strtolower($str), $matches)) {
                $ContentType = explode(': ', $matches[0]);
                if (isset($ContentType[1])) {
                    $ImgMimeType = new ImageMimeType($ContentType[1]);
                    return $ImgMimeType->isValid();
                }
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}