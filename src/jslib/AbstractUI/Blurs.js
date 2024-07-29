/**
 * @param {string} id 标签的id
 * @param {number} blur 模糊度(单位px)
 */
export function blurs(id,blur) {
    const element = document.getElementById(id);
    element.style.filter = `blur(${blur}px)`;
}