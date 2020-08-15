import React from 'react';
import ReactDOM from 'react-dom';
import { AppProvider } from '@shopify/polaris';
import { Provider } from '@shopify/app-bridge-react';
import enTranslations from '@shopify/polaris/locales/en.json';
import {config} from './functions';
import {App} from './components';

const shopOrigin = config('shop.shopify_domain');
const apiKey = config('shopify.api_key');

ReactDOM.render(
    <AppProvider
        i18n={enTranslations}>
        <Provider
            config={{
                apiKey,
                shopOrigin,
                forceRedirect: config('force_redirect'),
            }}>
            <App />
        </Provider>
    </AppProvider>,
    document.getElementById('app')
);
