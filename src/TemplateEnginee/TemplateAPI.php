<?php

namespace TemplateEnginee;


class TemplateAPI {
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
            if (!is_array($value)) {
                $template = str_replace('{{ ' . $name . ' }}', $value, $template);
            }
        }


        $template = preg_replace_callback(
            '/\{\% if\s+(.*?)\s+\%\}(.*?)\{\%\s+endif\s+\%\}/is',
            function ($matches) {
                $condition = trim($matches[1]);
                $inner = $matches[2];
                return eval("return {$condition} ? '{$inner}' : '';");
            },
            $template
        );

        $template = preg_replace_callback(
            '/\{\% for\s+(.*?)\sin\s(.*?)\s+\%\}(.*?)\{\%\s+endfor\s+\%\}/is',
            function ($matches) {
                $item = trim($matches[1]);
                $items = $this->vars[trim($matches[2])];
                $inner = $matches[3];

                $result = '';
                if (is_array($items)) {
                    foreach ($items as $value) {
                        $context = [
                            $item => $value,
                        ];
                        $result .= $this->parseTemplateWithContext($inner, $context);
                    }
                }
                return $result;
            },
            $template
        );

        return $template;
    }

    private function parseTemplateWithContext($template, $context)
    {
        foreach ($context as $name => $value) {
            $template = str_replace('{{ ' . $name . ' }}', $value, $template);
        }
        return $template;
    }


}