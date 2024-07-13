<?php

namespace TemplateEnginee;

abstract class ITemplateEnginee
{
    private $template;
    protected $vars = [];

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function assign($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function render()
    {
        return $this->parseTemplate($this->template);
    }

    private function parseTemplate($template)
    {
        foreach ($this->vars as $name => $value) {
            $template = str_replace('{{ ' . $name . ' }}', $value, $template);
        }
        return $template;
    }
}