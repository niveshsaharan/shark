<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('shopify-app.app_name') }}</title>
        <script>
            window.Env = {!! json_encode([
                'env'                     => config('app.env'),
                'base_url'                => config('app.url'),
                'csrfToken'               => csrf_token(),
                'shopify' => \Illuminate\Support\Arr::only(config('shopify-app'), [
                    'appbridge_enabled',
                    'appbridge_version',
                    'app_name',
                    'app_slug',
                    'api_key',
                    'api_redirect',
                ]),
                'shop' => [
                    'shopify_domain' => auth()->user()->getDomain()->toNative()
                ]
            ],JSON_PRETTY_PRINT) !!};
        </script>
        @yield('styles')
    </head>

    <body>
        <div class="app-wrapper">
            <div class="app-content">
                <main role="main">
                    @yield('content')
                </main>
            </div>
        </div>

        @if(config('shopify-app.appbridge_enabled'))
            <script src="https://unpkg.com/@shopify/app-bridge{{ config('shopify-app.appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
            <script>
                var AppBridge = window['app-bridge'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: '{{ config('shopify-app.api_key') }}',
                    shopOrigin: '{{ auth()->user()->getDomain()->toNative() }}',
                    forceRedirect: true,
                });
            </script>

            @include('shopify-app::partials.flash_messages')
        @endif

        @yield('scripts')
    </body>
</html>
