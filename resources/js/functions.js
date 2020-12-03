import { Inertia } from '@inertiajs/inertia';
import { default as ziggyRoute } from '../../vendor/tightenco/ziggy/src/js/route.js';
import { Ziggy } from './ziggy';

export function object_get(object, key, $default = null) {
    const value = key
        .split('.')
        .reduce((a, b) => (typeof a === 'object' ? a[b] : undefined), object);

    if (!value && $default) {
        return $default;
    }

    return value;
}

export function config(key, $default = null) {
    return object_get(window.Env, key, $default);
}

export function route(name, params, absolute) {
    return ziggyRoute(name, params, absolute, Ziggy);
}

export function redirectTop(props, url, options = {}) {
    if (window.top !== window.self) {
        if(config('shopify_token'))
        {
            url = new URL(url);
            url.searchParams.append('token', config('shopify_token'));

            const data = JSON.stringify({
                message: 'Shopify.API.remoteRedirect',
                data: { location: url.href },
            });

            window.parent.postMessage(
                data,
                `https://${config('shop.shopify_domain')}`
            );
        }
        else{
            alert("Shopify token was not found.")
            window.open(url);
        }
    } else {
        Inertia.visit(url, options);
    }
}

export function isMobile() {
    const match = window.matchMedia('(pointer:coarse)');
    return match && match.matches;
}
