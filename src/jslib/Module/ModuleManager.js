import {sendRequest} from "../Post";
import {sleep} from "../Sleep";
import {checkRoute, parseParams, renderPage} from "../Route";

export class ModuleManager {

    /**
     * @param {int} num
     */
    sleep(num) {
        sleep(num);
    }

    /**
     * @param {string} url
     * @param type
     * @param body
     * @param {int} debugmode
     */
    sendRequest(url, type, body, debugmode) {
        sendRequest(url, type, body, debugmode);
    }

    /**
     * @param {string} path
     * @param params
     */
    renderPage(path, params = {}) {
        renderPage(path, params);
    }

    /**
     * 检查路由
     */
    checkRoute() {
        checkRoute();
    }

    /**
     * @param {string} url
     * @param pattern
     */
    parseParams(url, pattern) {
        parseParams(url, pattern);
    }

}