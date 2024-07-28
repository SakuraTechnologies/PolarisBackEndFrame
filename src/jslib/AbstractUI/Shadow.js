/**
 * 设置阴影
 * @param {string} id 元素id
 * @param {number} h_offset 水平偏移
 * @param {number} v_offset 垂直偏移
 * @param {number} blur 模糊度
 * @param {number} spread 扩散度
 * @param {string} color 阴影颜色
 * @param {boolean} inset 是否为内阴影
 */
export function shadow(h_offset,v_offset,blur,spread,color,inset) {
    //获取元素
    let element = document.getElementById(id);
    //设置阴影
    if (inset) {
        element.style.boxShadow = `inset ${h_offset}px ${v_offset}px ${blur}px ${spread}px ${color}`;
    }else{
    element.style.boxShadow = `${h_offset}px ${v_offset}px ${blur}px ${spread}px ${color}`;
    }
}