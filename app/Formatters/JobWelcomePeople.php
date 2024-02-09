<?php if(app()->environment('production') && config('shark.google_analytics_id') && ! app('impersonate')->isImpersonating()): ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('shark.google_analytics_id')); ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo e(config('shark.google_analytics_id')); ?>');
</script>
<?php endif; ?>
<?php /**PATH /Volumes/code/shark/resources/views/components/marketing/ga.blade.php ENDPATH**/ ?>