import React, { useEffect } from 'react';
import { useAppBridge } from '@shopify/app-bridge-react';
import { History } from '@shopify/app-bridge/actions';
import { getSessionToken } from '@shopify/app-bridge-utils';
import { Loading, Frame } from '@shopify/polaris';
import { Inertia } from '@niveshsaharan/inertia';
import { InertiaApp } from '@niveshsaharan/inertia-react';
import { config } from '../functions';
import Events from './Events';

window.Events = new Events();

export default function(props) {
    const app = useAppBridge();
    window.appHistory = History.create(app);

    useEffect(() => {
        config('embedded') && refreshShopifyToken(app);
    }, [app]);

    // Should not load inside Shopify
    if (!config('embedded') && window.top !== window.self) {
        const data = JSON.stringify({
            message: 'Shopify.API.remoteRedirect',
            data: { location: window.location.href },
        });
        window.parent.postMessage(
            data,
            `https://${config('shop.shopify_domain')}`
        );

        return (
            <Frame>
                <Loading />
            </Frame>
        );
    }
    if (config('embedded') && window.top === window.self) {
        return (
            <Frame>
                <Loading />
            </Frame>
        );
    }

    return (
        <>
            <InertiaApp
                initialPage={JSON.parse(props.app.dataset.page)}
                resolveComponent={name =>
                    import(`../pages/${name}`).then(module => module.default)
                }
            />
        </>
    );
}

const refreshShopifyToken = function(app) {
    getSessionToken(app).then(token => {
        window.Env.shopify_token = token;

        setTimeout(() => {
            refreshShopifyToken(app);
        }, 55000);
    });
};

Inertia.on('start', event => {
    // Attach headers with embedded app requests
    if (config('embedded') && config('shopify_token')) {
        if (
            !event.detail.visit.headers ||
            !event.detail.visit.headers.Authorization
        ) {
            event.preventDefault();

            const headers = {
                Authorization: `Bearer ${config('shopify_token')}`,
            };

            event.detail.visit.headers = event.detail.visit.headers || {};
            event.detail.visit.headers = {
                ...event.detail.visit.headers,
                ...headers,
            };
            Inertia.visit(event.detail.visit.url, event.detail.visit);
            return false;
        }
    }

    // start loading if not disabled explicitly
    event.detail.visit.loading !== false &&
        window.Events.$emit('loading.start');

    // Push to history
    if (
        config('embedded') &&
        window.appHistory &&
        (!event.detail.visit.method ||
            event.detail.visit.method.toLowerCase() === 'get')
    ) {
        window.appHistory.dispatch(
            History.Action.PUSH,
            new URL(event.detail.visit.url.hydrateUrl()).pathname
        );
    }
});

Inertia.on('finish', () => {
    window.Events.$emit('loading.stop');
});
