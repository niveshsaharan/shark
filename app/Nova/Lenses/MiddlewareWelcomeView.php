<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(config('shopify-app.app_name')); ?></title>
    <link href="<?php echo e(mix('/css/polaris.css')); ?>" type="text/css" rel="stylesheet" />
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.marketing.gtm','data' => []]); ?>
<?php $component->withName('marketing.gtm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.marketing.ga','data' => []]); ?>
<?php $component->withName('marketing.ga'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    <script>
        window.Env = <?php echo json_encode([
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
            ],JSON_PRETTY_PRINT); ?>;
    </script>
</head>
<body>
    <div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div>
    <script src="<?php echo e(mix('/js/app.js')); ?>" type="text/javascript"></script>
</body>
</html>
<?php /**PATH /Volumes/www/shark/resources/views/app.blade.php ENDPATH**/ ?>