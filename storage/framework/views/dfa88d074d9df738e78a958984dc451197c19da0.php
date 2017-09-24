<?php $__env->startSection('content'); ?>
<main class="main">
    <div class="container flex flex-top">
        <?php echo $__env->make('app.instruments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('app.graph', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('app.deals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>

    <?php echo $__env->make('layouts.bottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</main>

<footer class="footer">
    <div class="container"></div>
</footer>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>