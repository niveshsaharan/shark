<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('shopify-app.app_name') }}</title>
    <link href="{{mix('/css/polaris.css')}}" type="text/css" rel="stylesheet" />
    <x-marketing.gtm />
    <x-marketing.ga />
    <script>
        window.Env = {!! json_encode([
                'env'                     => config('app.env'),
                'base_url'                => config('app.url'),
                'csrfToken'               => csrf_token(),
                'shopify' => array_replace_recursive(\Illuminate\Support\Arr::only(config('shopify-app'), [
                    'appbridge_enabled',
                    'appbridge_version',
                    'app_name',
                    'api_redirect',
                ]), [
                    'api_key' => auth()->user()->api()->getOptions()->getApiKey()
                ]),
                 'shark' => \Illuminate\Support\Arr::only(config('shark'), [
                    'shopify_affiliate_url',
                    'app_slug',
                    'app_description',
                    'demo_url',
                    'faq_url',
                ]),
                'shop' => [
                    'name' => auth()->user()->shop_name,
                    'shopify_domain' => auth()->user()->getDomain()->toNative(),
                    'domain' => auth()->user()->domain ?: auth()->user()->getDomain()->toNative(),
                ],
                'embedded' =>  auth()->user()->isUsingEmbeddedApp(),
                'standalone' =>  ! auth()->user()->isUsingEmbeddedApp(),
                'impersonated' => app('impersonate')->isImpersonating(),
                'color_scheme' => 'light'
            ],JSON_PRETTY_PRINT) !!};
    </script>
</head>
<body>
    @inertia
    <script src="{{mix('/js/app.js')}}" type="text/javascript"></script>
</body>
</html>
