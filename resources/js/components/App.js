import React from 'react';
import { Context } from '@shopify/app-bridge-react';
import { getSessionToken } from '@shopify/app-bridge-utils';
import { InertiaApp } from '@inertiajs/inertia-react'
import {config} from "../functions";
import { LoadingListener, FlashListener, ConfirmListener } from '.';
import Events from './Events';
window.Events = new Events();

export default function(props) {
    return (
        <>
            <Context.Consumer>
                {app => {
                    if (app) {
                        if (config('shopify.appbridge_enabled')) {
                            axiosApiClient.interceptors.request.use((config) => {
                                    return getSessionToken(app)
                                        .then((token) => {
                                            config.headers['Authorization'] = `Bearer ${token}`;
                                            return config;
                                        });
                                }
                            );
                        } else {
                            // Should not load inside Shopify
                            if (window.top !== window.self) {
                                const data = JSON.stringify({
                                    message: 'Shopify.API.remoteRedirect',
                                    data: {location: window.location.href},
                                });
                                window.parent.postMessage(data, "https://" + config('shop.shopify_domain'));
                            }
                        }

                        return (
                            <>
                                <InertiaApp
                                    initialPage={JSON.parse(props.app.dataset.page)}
                                    resolveComponent={name => import(`../pages/${name}`).then(module => module.default)}
                                />
                                <LoadingListener/>
                                <FlashListener/>
                                <ConfirmListener/>
                            </>
                        );
                    }

                    return null;
                }}
            </Context.Consumer>
        </>
    );
}
