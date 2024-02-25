

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="form-group">
                    <select id="phd_select" class="form-control">
                        <?php $__currentLoopData = $phds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_phd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $condition_name = json_decode($_phd->medical->conditions)[0]->name;
                            ?>
                            <option value="<?php echo e(url('/patient/' . $_phd->id)); ?>"> <?php echo e($condition_name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><?php echo e($phd->patient->Name); ?> <?php echo e($phd->patient->Surname); ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Gender:</strong> <?php echo e($phd->patient->Gender); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo e($phd->patient->DateOfBirth); ?></p>
                    <p><strong>Address:</strong> <?php echo e($phd->patient->Address); ?></p>
                    <p><strong>Postcode:</strong> <?php echo e($phd->patient->Postcode); ?></p>
                    <p><strong>Contact Number 1:</strong> <?php echo e($phd->patient->ContactNumber1); ?></p>
                    <p><strong>Contact Number 2:</strong> <?php echo e($phd->patient->ContactNumber2); ?></p>
                </div>
                <div class="col-md-4 text-right">
                    <?php if($phd->patient->Gender == 'Male'): ?>
                        <img src="<?php echo e(asset('images/male_avatar.png')); ?>" class="rounded-circle mb-3" alt="MaleAvatar"style="width: 200px; ">
                    <?php elseif($phd->patient->Gender == 'Female'): ?>
                        <img src="<?php echo e(asset('images/female_avatar.png')); ?>" class="rounded-circle mb-3" alt="FemaleAvatar"style="width: 200px; ">
                    <?php endif; ?>
                </div>
            </div>

            <hr>

            <h6>Next of Kin:</h6>
            <div class="row">
                <?php $__currentLoopData = $nextOfKins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nextOfKin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                        <ul>
                            <li>Name: <?php echo e($nextOfKin->Name); ?></li>
                            <li>Surname: <?php echo e($nextOfKin->Surname); ?></li>
                            <li>Contact Number 1: <?php echo e($nextOfKin->ContactNumber1); ?></li>
                            <li>Contact Number 2: <?php echo e($nextOfKin->ContactNumber2); ?></li>
                        </ul>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div> 

            <hr>

            <h6>Medical Information:</h6>
            <p><strong>Conditions:</strong></p>
            <ul>
                <?php $__currentLoopData = json_decode($phd->medical->conditions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($condition->name); ?> - <?php echo e($condition->notes); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <p><strong>Allergies:</strong></p>
            <ul>
                <?php $__currentLoopData = json_decode($phd->medical->alergies); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($allergy->name); ?> - <?php echo e($allergy->notes); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <p><strong>Medication:</strong></p>
            <ul>
                <?php $__currentLoopData = json_decode($phd->medical->medication); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($medication->name); ?> - <?php echo e($medication->notes); ?></li>
                <li><?php echo e($medication->start_date); ?> - <?php echo e($medication->end_date); ?></li>
                <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // JavaScript ile URL değiştirme
        document.getElementById('phd_select').addEventListener('change', function() {
            var selectedUrl = this.value;
            if (selectedUrl) {
                window.location.href = selectedUrl;
            }
        });
         var selectElement = document.getElementById('phd_select');
        var url = window.location.href;
        var selectedId = url.substring(url.lastIndexOf('/') + 1);

        // Seçili seçeneği belirle
        var options = selectElement.options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].value.endsWith(selectedId)) {
                options[i].setAttribute('selected', 'selected');
                break; // Uygun seçeneği bulduğumuzda döngüyü sonlandırın
            }
        }
    });
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/patients/show.blade.php ENDPATH**/ ?>