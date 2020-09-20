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
