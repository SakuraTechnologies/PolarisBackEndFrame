// 获取画布元素和2D绘图上下文
const canvas = document.getElementById('particleCanvas');
const ctx = canvas.getContext('2d');

// 设置画布大小与浏览器窗口大小一致
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

/**
 * 粒子类，用于表示画布上的单个粒子
 */
class Particle {
    /**
     * 构造函数，初始化粒子的属性
     * @param {number} x - 粒子的初始x坐标
     * @param {number} y - 粒子的初始y坐标
     * @param {number} radius - 粒子的半径
     * @param {string} color - 粒子的颜色
     */
    constructor(x, y, radius, color) {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.color = color;
        // 初始化粒子的速度，随机在-3到3之间
        this.velocity = {
            x: (Math.random() * 6) - 3,
            y: (Math.random() * 6) - 3
        };
        // 随机粒子的透明度
        this.opacity = Math.random();
    }

    /**
     * 绘制粒子
     */
    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        // 设置粒子颜色和透明度
        ctx.fillStyle = `rgba(${this.color},${this.opacity})`;
        ctx.fill();
    }

    /**
     * 更新粒子的状态，包括位置和绘制
     */
    update() {
        // 根据速度更新粒子位置
        this.x += this.velocity.x;
        this.y += this.velocity.y;

        // 碰撞边界反弹
        // 边界检测
        if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
            this.velocity.x = -this.velocity.x;
        }
        if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
            this.velocity.y = -this.velocity.y;
        }

        // 重新绘制粒子
        this.draw();
    }
}

// 初始化粒子数组和粒子系统
let particlesArray;

/**
 * 初始化函数，用于创建粒子数组
 */
function init() {
    particlesArray = [];
    const numberOfParticles = 100; // 粒子数量
    for (let i = 0; i < numberOfParticles; i++) {
        // 随机生成粒子的半径、位置和颜色
        const radius = (Math.random() * 5) + 1;
        const x = (Math.random() * ((innerWidth - radius * 2) - (radius * 2))) + radius * 2;
        const y = (Math.random() * ((innerHeight - radius * 2) - (radius * 2))) + radius * 2;
        const color = `rgb(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255})`;
        // 创建粒子并添加到数组
        particlesArray.push(new Particle(x, y, radius, color));
    }
}

/**
 * 动画函数，用于持续更新和绘制粒子
 */
function animate() {
    requestAnimationFrame(animate); // 递归调用自身以实现动画
    // 清空画布以便重新绘制
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    // 更新和绘制所有粒子
    for (let i = 0; i < particlesArray.length; i++) {
        particlesArray[i].update();
    }
}
