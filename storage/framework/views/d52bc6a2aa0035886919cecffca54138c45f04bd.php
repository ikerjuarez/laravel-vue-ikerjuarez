<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Escape Room</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/main">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/seeUsers">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Jocs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reserves</a>
                </li>
                <li class="nav-item">
                    <?php if(auth()->guard()->check()): ?>
                        <div>
                            <span class="nav-link"><?php echo e(Auth::user()->name); ?></span>
                        </div>
                    <?php else: ?>
                        <a href="/">LOGIN</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/templates/nav.blade.php ENDPATH**/ ?>