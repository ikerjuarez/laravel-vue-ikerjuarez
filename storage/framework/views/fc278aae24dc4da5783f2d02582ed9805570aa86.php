<?php $__env->startSection('titol'); ?>
    Register form
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contingut'); ?>
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>Register form</h1>
        </div>
        <form method="post" action="/registerUser" class="row">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="col-sm-6">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="col-sm-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="tel" name="name" class="form-control" id="inputName">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="col-sm-2 mt-2 btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('templates.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/register.blade.php ENDPATH**/ ?>