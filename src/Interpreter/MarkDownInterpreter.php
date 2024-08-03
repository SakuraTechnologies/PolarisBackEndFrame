<?php

class MarkDownInterpreter
{
    public function parse($markdown)
    {
        $html = '';

        // 处理标题
        $html .= preg_replace_callback('/^(#+)\s(.*)$/m', [$this, 'handleHeading'], $markdown);

        // 处理加粗
        $html = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $html);

        // 处理斜体
        $html = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $html);

        // 处理无序列表
        $html = preg_replace_callback('/^(\s*)\-(.*)$/m', [$this, 'handleUnorderedList'], $html);

        // 处理有序列表
        $html = preg_replace_callback('/^(\s*)(\d+)\.\s(.*)$/m', [$this, 'handleOrderedList'], $html);

        return $html;
    }

    private function handleHeading($matches)
    {
        $level = strlen($matches[1]);
        $content = $matches[2];
        return "<h$level>$content</h$level>";
    }

    private function handleUnorderedList($matches)
    {
        $indent = strlen($matches[1]);
        $item = $matches[2];

        // 使用缩进来确定嵌套层级
        $level = floor($indent / 4);
        $listTag = $level ? str_repeat('</ul>', $level - 1) : '';
        $listTag .= '<ul>';
        $listItem = "<li>$item</li>";

        return $listTag . $listItem;
    }

    private function handleOrderedList($matches)
    {
        $indent = strlen($matches[1]);
        $number = $matches[2];
        $item = $matches[3];

        // 使用缩进来确定嵌套层级
        $level = floor($indent / 4);
        $listTag = $level ? str_repeat('</ol>', $level - 1) : '';
        $listTag .= '<ol>';
        $listItem = "<li>$item</li>";

        return $listTag . $listItem;
    }
}