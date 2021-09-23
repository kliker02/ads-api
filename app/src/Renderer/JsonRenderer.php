<?php


namespace Kliker02\VcruTask\Renderer;

/**
 * @author Alex Tokunov
 * Class JsonRenderer
 * @package Kliker02\VcruTask\Renderer
 */
class JsonRenderer implements RendererInterface
{

    /**
     * @var array
     */
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        return json_encode($this->data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}