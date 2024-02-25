

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Patients with <?php echo e($condition); ?></h2>
    <div class="row">
        <?php $__currentLoopData = $phds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4 patient">
            <div class="card">
                <div class="card-body text-center">
                    <?php if($phd->patient->Gender == 'Male'): ?>
                        <img src="<?php echo e(asset('images/male_avatar.png')); ?>" class="rounded-circle mb-3" alt="MaleAvatar" style="width: 100px; ">
                    <?php elseif($phd->patient->Gender == 'Female'): ?>
                        <img src="<?php echo e(asset('images/female_avatar.png')); ?>" class="rounded-circle mb-3" alt="FemaleAvatar" style="width: 100px; ">
                    <?php endif; ?>
                    <h5 class="card-title"><?php echo e($phd->patient->Name); ?> <?php echo e($phd->patient->Surname); ?></h5>
                    <p class="card-text"><?php echo e($phd->patient->Gender); ?></p>
                    <a href="/patient/<?php echo e($phd->id); ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();
            $('.patient').each(function(){
                var name = $(this).find('.card-title').text().toLowerCase(); // İsim ve soyisim bilgisini al
                if(name.indexOf(searchText) === -1){ // İsim veya soyisim arama metnini içermiyorsa
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/conditions/show.blade.php ENDPATH**/ ?>