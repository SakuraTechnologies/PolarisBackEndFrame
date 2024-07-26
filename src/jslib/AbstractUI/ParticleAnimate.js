const canvas = document.getElementById('particleCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Particle {
    constructor(x, y, radius, color) {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.color = color;
        this.velocity = {
            x: (Math.random() * 6) - 3,
            y: (Math.random() * 6) - 3
        };
        this.opacity = Math.random();
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        ctx.fillStyle = `rgba(${this.color},${this.opacity})`;
        ctx.fill();
    }

    update() {
        this.x += this.velocity.x;
        this.y += this.velocity.y;

        // 边界检测
        if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
            this.velocity.x = -this.velocity.x;
        }
        if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
            this.velocity.y = -this.velocity.y;
        }

        this.draw();
    }
}

let particlesArray;

function init() {
    particlesArray = [];
    const numberOfParticles = 100;
    for (let i = 0; i < numberOfParticles; i++) {
        const radius = (Math.random() * 5) + 1;
        const x = (Math.random() * ((innerWidth - radius * 2) - (radius * 2))) + radius * 2;
        const y = (Math.random() * ((innerHeight - radius * 2) - (radius * 2))) + radius * 2;
        const color = `rgb(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255})`;
        particlesArray.push(new Particle(x, y, radius, color));
    }
}

function animate() {
    requestAnimationFrame(animate);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    for (let i = 0; i < particlesArray.length; i++) {
        particlesArray[i].update();
    }
}

init();
animate();