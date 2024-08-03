<?php

class TemplateLoader
{
    private $templatePath;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render($templateName, $data)
    {
        $template = $this->load($templateName);
        foreach ($data as $key => $value) {
            // 确保替换的数据也为 UTF-8 编码
            $value = mb_convert_encoding($value, 'UTF-8');
            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        return $template;
    }

    public function load($templateName)
    {
        $filePath = $this->templatePath . '/' . $templateName;
        if (!file_exists($filePath)) {
            throw new Exception("Template file not found: " . $filePath);
        }
        // 加载模板文件并确保内容为 UTF-8 编码
        $template = file_get_contents($filePath);
        $template = mb_convert_encoding($template, 'UTF-8'); // 使用 mb_convert_encoding 来转换编码
        return $template;
    }
}