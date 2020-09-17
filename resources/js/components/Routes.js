import {BrowserRouter, Route, Switch} from "react-router-dom";
import {Home, PageNotFound} from "../pages";
import React from "react";

export default function () {
    return  <BrowserRouter>
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
}
