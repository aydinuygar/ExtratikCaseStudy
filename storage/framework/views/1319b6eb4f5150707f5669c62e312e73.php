

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container mt-4 mb-4">
        <input type="text" class="form-control" id="searchInput" placeholder="Search...">
        <small class="text-muted">You can search by name.</small>
    </div>
    <h2>Conditions List</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Condition</th>
                <th>Patient Count</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $conditionsCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="condition">
                <td><a href="/condition/<?php echo e($key); ?>"><?php echo e($key); ?></a></td>
                <td><?php echo e($value); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();
            $('.condition').each(function(){
                var conditionName = $(this).find('td:first-child').text().toLowerCase(); // Durum ismini al
                if(conditionName.indexOf(searchText) === -1){ // Durum adı arama metnini içermiyorsa
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/conditions/index.blade.php ENDPATH**/ ?>