<?php $__env->startSection('content'); ?>
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>User's List</h1>
        </div>
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td>
                        <a href="/user/<?php echo e($user->id); ?>/update" class="btn btn-primary">Modify</a>
                    </td>
                    <td>
                        <a href="/user/<?php echo e($user->id); ?>/delete" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/user/seeUsers.blade.php ENDPATH**/ ?>