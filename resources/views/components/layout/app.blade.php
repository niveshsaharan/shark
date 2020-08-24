<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('shopify-app.app_name') }}</title>
    <link href="{{asset('/css/polaris.css')}}" type="text/css" rel="stylesheet" />
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
                    'demo_url'
                ]),
                'shop' => [
                    'shopify_domain' => auth()->user()->name
                ],
                'force_redirect' => config('shopify-app.appbridge_enabled'), // Can have multiple conditions in future like impersonating a shop
            ],JSON_PRETTY_PRINT) !!};
    </script>
</head>
<body>
    <div id="app">
        {{ $slot }}
    </div>
    <script src="{{asset('/js/app.js')}}" type="text/javascript"></script>
</body>
</html>
