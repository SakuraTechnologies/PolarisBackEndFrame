/** 
* @param string id 标签的id
* @param string originalText 要输出的字符串
* @param number interval 输出间隔时间，单位ms
*/
export function typewriter(id, originalText, interval) {
    let text = "";
    const element = document.getElementById(id);

    function writeText(i) {
        if (i < originalText.length) {
            text += originalText[i];
            element.innerText = text;
            //递归，并等待一定时间
            setTimeout(() => writeText(i + 1), interval);
        }
    }
    //第一次执行，调用writeText函数
    writeText(0);
}
    //使用示例：
    //typewriter("content","Helloworld",1000);
    //在一个id为content的标签中，每0.1秒输出一个字符串
    


    
