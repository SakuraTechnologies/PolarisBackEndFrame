//暴露函数
//url参数填写网址，type参数填写请求类型，body参数填写请发送内容，debugmode参数填写数字
export function sendRquest(url,type,body,debugmode){
//发送请求
    //设置result变量，如果发生错误则返回null
    let result = null;
    if(type == "POST"){
            //发送post请求
            result = fetch(url,{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify({body})
        })
        .catch(err=>{
            console.log(err)
        })
    }
    if(type == "GET"){
        //发送get请求
        result = fetch(url)
        .then(res=>res.json())
        .catch(err=>{
            console.log(err)
        })
    }else{
        console.log("请求类型错误")
    }
    if(debugmode == 3){
        console.log(result)
    }
    return result
}