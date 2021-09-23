<?php


namespace Kliker02\VcruTask;


use Laminas\Http\Header\MultipleHeaderInterface;
use Laminas\Http\Response;

/**
 * @author Alex Tokunov
 * Class ResponseSender
 * @package Kliker02\VcruTask
 */
class ResponseSender
{
    public static function send(Response $response) {
        http_response_code($response->getStatusCode());

        foreach ($response->getHeaders() as $header) {
            if ($header instanceof MultipleHeaderInterface) {
                header($header->toString(), false);
                continue;
            }
            header($header->toString());
        }

        echo $response->getContent();
    }
}