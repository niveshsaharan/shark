<?php $__env->startSection('content'); ?>
    <loading ref="loading"></loading>

    <fade-transition>
        <router-view :key="$route.name + ($route.params.resourceName || '')"></router-view>
    </fade-transition>

    <portal-target name="modals" transition="fade-transition"></portal-target>
    <portal-target name="dropdowns" transition="fade-transition"></portal-target>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('nova::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/www/shark/vendor/laravel/nova/src/../resources/views/router.blade.php ENDPATH**/ ?>