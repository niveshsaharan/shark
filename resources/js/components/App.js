import React from 'react';
import { Context } from '@shopify/app-bridge-react';
import { getSessionToken } from '@shopify/app-bridge-utils';
import { InertiaApp } from '@niveshsaharan/inertia-react';
import { config } from '../functions';
import { LoadingListener, FlashListener, ConfirmListener } from '.';
import Events from './Events';

window.Events = new Events();

export default function(props) {
    return (
        <>
            <Context.Consumer>
                {app => {
                    if (app) {
                        if (!config('embedded')) {
                            // Should not load inside Shopify
                            if (window.top !== window.self) {
                                const data = JSON.stringify({
                                    message: 'Shopify.API.remoteRedirect',
                                    data: { location: window.location.href },
                                });
                                window.parent.postMessage(
                                    data,
                                    `https://${config('shop.shopify_domain')}`
                                );

                                return null;
                            }
                        }

                        return (
                            <>
                                <InertiaApp
                                    initialPage={JSON.parse(
                                        props.app.dataset.page
                                    )}
                                    resolveComponent={name =>
                                        import(`../pages/${name}`).then(
                                            module => module.default
                                        )}
                                    transformProps={props => ({
                                        ...props,
                                        beforeSend: () => beforeSend(app),
                                    })}
                                />
                                <LoadingListener />
                                <FlashListener />
                                <ConfirmListener />
                            </>
                        );
                    }

                    return null;
                }}
            </Context.Consumer>
        </>
    );
}

/**
 * Before send
 *
 * @param app
 * @returns {Promise<{headers: {}}>}
 */
const beforeSend = async function(app) {
    const response = {
        headers: {},
    };

    if (config('embedded')) {
        const token = await getSessionToken(app);

        if (token) {
            response.headers.Authorization = `Bearer ${token}`;
        }
    }

    return response;
};
