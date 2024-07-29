import {blurredGlass} from "../BlurredGlass";
import {animate, init} from "../ParticleAnimate";
import {shadow} from "../Shadow";
import {typewriter} from "../Typewriter";

export class AnimateManager {

    /**
     * 模糊玻璃
     * @param id
     * @param blur
     */
    BlurredGlass(id, blur) {
        blurredGlass(id, blur);
    }

    /**
     * 打字机
     * @param id
     * @param originalText
     * @param interval
     */
    Typewriter(id, originalText, interval) {
        typewriter(id, originalText, interval);
    }

    /**
     * 粒子特效
     * @param numberOfParticles
     */
    ParticleAnimate(numberOfParticles) {
        init(numberOfParticles);
        animate();
    }

    /**
     * 阴影
     * @param h_offset
     * @param v_offset
     * @param blur
     * @param spread
     * @param color
     * @param inset
     */
    Shadow(h_offset, v_offset, blur, spread, color, inset) {
        shadow(h_offset, v_offset, blur, spread, color, inset);
    }
}

