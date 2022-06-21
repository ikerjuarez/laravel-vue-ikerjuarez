<?php $__env->startSection('content'); ?>
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>Update form</h1>
        </div>
            <form method="post" action="/updateUser" class="row">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($userToUpdate->id); ?>">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" readonly id="inputEmail" aria-describedby="emailHelp" value="<?php echo e($userToUpdate->email); ?>">
                </div>
                <div class="col-sm-6">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="col-sm-6">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="tel" name="name" class="form-control" id="inputName" value="<?php echo e($userToUpdate->name); ?>">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="col-sm-2 mt-2 btn btn-primary">Submit</button>
                    <a class="col-sm-2 mt-2 btn btn-danger" href="/main" style="margin-left: 10px">Cancel</a>
                </div>
            </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/updateUser.blade.php ENDPATH**/ ?>