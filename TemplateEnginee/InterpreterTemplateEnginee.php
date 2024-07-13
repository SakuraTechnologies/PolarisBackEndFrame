<?php

namespace TemplateEnginee;

class InterpreterTemplateEnginee extends ITemplateEnginee
{
    public function parseTemplate($template)
    {
        foreach ($this->vars as $name => $value) {
            $template = str_replace('{{ ' . $name . ' }}', $value, $template);
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

        return $template;
    }


}
