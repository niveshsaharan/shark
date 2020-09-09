import React from 'react';
import { Context } from '@shopify/app-bridge-react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import { LoadingListener, FlashListener, ConfirmListener } from '.';
import { Home, PageNotFound } from '../pages';
import Events from './Events';

window.Events = new Events();

export default function() {
    return (
        <>
            <Context.Consumer>
                {app => {
                    // Do something with App Bridge `app` instance...
                    if (app) {
                        // app.getState().then(state => console.log(state));
                    }

                    return (
                        <>
                            <BrowserRouter>
                                <Switch>
                                    <Route
                                        path="/"
                                        exact
                                        render={props => (
                                            <Home {...props} title="Home" />
                                        )}
                                    />
                                    <Route component={PageNotFound} />
                                </Switch>
                            </BrowserRouter>
                            <LoadingListener />
                            <FlashListener />
                            <ConfirmListener />
                        </>
                    );
                }}
            </Context.Consumer>
        </>
    );
}
