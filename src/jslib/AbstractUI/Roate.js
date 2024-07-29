


/**
 * 旋转
 * @param {string} id 元素id
 * @example const abc = new rotate('rotating-element')
 * abc.start(1)
 * abc.end()
 */
class rotate{
    constructor(id){
        this.id = id;
        this.element = document.getElementById('rotating-element');
        this.isend = false;
    }
    /**
     * 开始旋转
     * @param {number} speed 每秒旋转的圈数
     * @returns 
     */
    start(speed){
        let a = 0
        function rotate(degrees) {
            element.style.transform = `rotate(${degrees}deg)`;
          }
        while(true){
            a += (speed*7.2)
            if(this.is_end){
                return 0
            }
            setTimeout(() => rotate(a), 20);
        }

    }

/**
 * 结束旋转
 */
    end(){
        this.is_end = true;
    }
}