//暴露函数
export function sendRquest(url,body){
    //发送请求
    try{
    fetch(url,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({body})
    })
    }catch(err){
    console.log(err)}

    
}