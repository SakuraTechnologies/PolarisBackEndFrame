export function sleep(milliSeconds) {
        var startTime = new Date().getTime();
        while (new Date().getTime() < startTime + milliSeconds) {
            console.log(new Date().getTime());
        }//暂停一段时间 10000=1S。
    }