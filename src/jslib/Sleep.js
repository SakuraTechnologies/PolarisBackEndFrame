/**
 * @description: 暂停一段时间
 * @return {*}
 * @param milliSeconds
 */
export function sleep(milliSeconds) {
    return new Promise(resolve => {
        setTimeout(resolve, milliSeconds);
    });
    }//暂停一段时间 1000=1S。
    //需要用async和await