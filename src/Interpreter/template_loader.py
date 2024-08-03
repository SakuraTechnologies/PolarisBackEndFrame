import subprocess

class TemplateLoader:
    def __init__(self, template_path):
        self.template_path = template_path

    def render(self, template_name, data):
        # 使用 subprocess Popen 调用 PHP 脚本
        with subprocess.Popen(['php', './PythonTemplateLoader.php', template_name],
                              stdout=subprocess.PIPE,
                              stderr=subprocess.PIPE,
                              text=True) as process:
            # 读取标准输出
            utf8_output, err = process.communicate()

        # 检查是否有错误输出
        if err:
            raise Exception(f"Error rendering template: {err}")

        # 返回渲染后的模板输出
        return utf8_output.strip()
