<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->isAdmin == true): ?>
    <div class="container">
        <joc></joc>
    </div>
    <?php else: ?>
        <div class="container" style="width: 100%; height: 100%;">
            <div class="d-flex justify-content-center">
                <h1>Only user Admin can access this page</h1>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/game/game.blade.php ENDPATH**/ ?>