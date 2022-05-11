<?php $__env->startSection('title'); ?>
    Main page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contingut'); ?>
    this is the main page of the escape room
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/main.blade.php ENDPATH**/ ?>