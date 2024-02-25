

<?php $__env->startSection('content'); ?>
<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Delete Patient</h2>
    </div>

    <form  action="<?php echo e(url('/patient/save')); ?>" method="post">
         <?php echo csrf_field(); ?>
         	<input type="hidden" name="crud" value="delete">
            <input type="hidden" name="phd_id" value="<?php echo e(Request::segment(3)); ?>">


            <div class="form-group">
                <label for="IdCard">IdCard:</label>
                <input type="text" class="form-control" id="IdCard" name="IdCard" value="<?php echo e($phd->patient->IdCard); ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($phd->patient->Name); ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo e($phd->patient->Surname); ?>" readonly required>
            </div>
       

			<div class="form-row mt-3">
			    <div class="col">
			        <button type="submit" class="btn btn-danger">Delete</button>
			        <a href="/patients/edit/<?php echo e(Request::segment(3)); ?>" class="btn btn-secondary">Cancel</a>
			    </div>
			</div>



    </form>
</div>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/patients/delete.blade.php ENDPATH**/ ?>