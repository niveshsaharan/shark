import React from 'react';
import { Context } from '@shopify/app-bridge-react';
import {config} from "../functions";
import { Routes, LoadingListener, FlashListener, ConfirmListener } from '.';
import Events from './Events';
window.Events = new Events();

export default function() {
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
                                <Routes app={app} />
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
