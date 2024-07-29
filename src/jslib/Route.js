const routes = {
    '/': () => {
        console.log('Home page');
        return '<h1>Home Page</h1>';
    },
};

/**
 * @description 渲染页面
 * @param path
 * @param params
 * @returns {string}
 */
export function renderPage(path, params = {}) {
    const route = routes[path];
    if (!route) {
        console.error('Route not found');
        return '<h1>404 Not Found</h1>';
    }
    const content = route(params);
    document.getElementById('content').innerHTML = content;
}

/**
 * @param url
 * @param pattern
 * @returns {{}|null}
 */
export function parseParams(url, pattern) {
    const regex = new RegExp(pattern.replace(/:[^\/]+/g, '([^/]+)'));
    const match = url.match(regex);
    if (match) {
        const params = {};
        pattern.replace(/:[^\/]+/g, (_, index) => {
            params[`param${index}`] = match[index + 1];
        });
        return params;
    }
    return null;
}


export function checkRoute() {
    const path = window.location.pathname;
    let params = {};
    for (let routePath in routes) {
        if (routePath.includes(':')) {
            params = parseParams(path, routePath);
            if (params !== null) {
                renderPage(routePath, params);
                return;
            }
        } else if (path === routePath) {
            renderPage(routePath);
            return;
        }
    }
    renderPage(null);
}

window.addEventListener('popstate', checkRoute);
checkRoute();
document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        window.history.pushState({}, '', e.target.href);
        checkRoute();
    });
});