

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
                            <option value="<?php echo e(url('/patient/edit/' . $_phd->id)); ?>"> <?php echo e($condition_name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Edit Patient Health Data</h2>
        <a href="<?php echo e(url('patient/delete/' . Request::segment(3))); ?>" class="btn btn-danger">Delete Patient</a>
    </div>

    <form  action="<?php echo e(url('/patient/save')); ?>" method="post">
         <?php echo csrf_field(); ?>
         	<input type="hidden" name="crud" value="edit">
            <input type="hidden" name="phd_id" value="<?php echo e(Request::segment(3)); ?>">


            <div class="form-group">
                <label for="IdCard">IdCard:</label>
                <input type="text" class="form-control" id="IdCard" name="IdCard" value="<?php echo e($phd->patient->IdCard); ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($phd->patient->Name); ?>" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo e($phd->patient->Surname); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required >
                    <option <?php if($phd->patient->Gender == 'Male'): ?> selected <?php endif; ?> value="Male">Male</option>
                    <option <?php if($phd->patient->Gender == 'Female'): ?> selected <?php endif; ?> value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e($phd->patient->DateOfBirth); ?>" required >
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo e($phd->patient->Address); ?>" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo e($phd->patient->Postcode); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_number1">Contact Number 1:</label>
                <input type="text" class="form-control" id="contact_number1" name="contact_number1" value="<?php echo e($phd->patient->ContactNumber1); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_number2">Contact Number 2:</label>
                <input type="text" class="form-control" id="contact_number2" name="contact_number2" value="<?php echo e($phd->patient->ContactNumber2); ?>" >
            </div>

            <!-- Next of Kin -->
            <div class="form-group" id="next_of_kin_fields">
                <label for="next_of_kin">Next of Kin:</label>
                <?php $__currentLoopData = $nextOfKins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nextOfKin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			    <div class="next-of-kin">
    			        <div class="form-row">
    			            <div class="col">
    			                <input type="text" class="form-control" value="<?php echo e($nextOfKin->IdCard); ?>" name="next_of_kin[][IdCard]" placeholder="ID Card" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="<?php echo e($nextOfKin->Name); ?>" name="next_of_kin[][Name]" placeholder="Name" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="<?php echo e($nextOfKin->Surname); ?>" name="next_of_kin[][Surname]" placeholder="Surname" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="<?php echo e($nextOfKin->ContactNumber1); ?>" name="next_of_kin[][ContactNumber1]" placeholder="Contact Number 1" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="<?php echo e($nextOfKin->ContactNumber2); ?>" name="next_of_kin[][ContactNumber2]" placeholder="Contact Number 2" >
    			            </div>
    			        </div>
    			    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
			<hr>
			<label for="conditions">Condition :</label>
			<div class="conditions">
                <?php $__currentLoopData = json_decode($phd->medical->conditions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			    <div class="form-row">
    			        <div class="col">
    			            <input type="text" class="form-control" name="conditions[][name]" value="<?php echo e($condition->name); ?>" placeholder="Name" required>
    			        </div>
    			        <div class="col">
    			            <input type="text" class="form-control" name="conditions[][notes]" value="<?php echo e($condition->notes); ?>" placeholder="Notes">
    			        </div>
    			    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<hr>
			<label for="allergies">Allergies :</label>
			<div class="allergies">
                 <?php $__currentLoopData = json_decode($phd->medical->alergies); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <div class="form-row">
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][name]" value="<?php echo e($allergy->name); ?> " placeholder="Name" required>
			        </div>
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][notes]" value="<?php echo e($allergy->notes); ?> " placeholder="Notes">
			        </div>
			    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<hr>
			<label for="medications">Medications :</label>
			<div class="medications">
                <?php $__currentLoopData = json_decode($phd->medical->medication); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="medications[][name]" value="<?php echo e($medication->name); ?>" placeholder="Name" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="medications[][notes]" value="<?php echo e($medication->notes); ?>" placeholder="Notes">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="medications[][start_date]" value="<?php echo e($medication->start_date); ?>" placeholder="Start Date" required>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="medications[][end_date]" value="<?php echo e($medication->end_date); ?>" placeholder="End Date">
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


			<div class="form-row mt-3">
			    <div class="col">
			        <button type="submit" class="btn btn-primary">Edit</button>
			        <a href="/patients" class="btn btn-secondary">Cancel</a>
			    </div>
			</div>



    </form>
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



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/patients/edit.blade.php ENDPATH**/ ?>