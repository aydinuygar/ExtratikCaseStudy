

<?php $__env->startSection('content'); ?>
<div class="container">


    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <h2>Add Patient</h2>
    <form  action="<?php echo e(url('/patient/save')); ?>" method="post">
         <?php echo csrf_field(); ?>
         	<input type="hidden" name="crud" value="add">


            <div class="form-group">
                <label for="IdCard">IdCard:</label>
                <input type="text" class="form-control" id="IdCard" name="IdCard" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" required>
            </div>
            <div class="form-group">
                <label for="contact_number1">Contact Number 1:</label>
                <input type="text" class="form-control" id="contact_number1" name="contact_number1" required>
            </div>
            <div class="form-group">
                <label for="contact_number2">Contact Number 2:</label>
                <input type="text" class="form-control" id="contact_number2" name="contact_number2" >
            </div>

            <!-- Next of Kin -->
            <div class="form-group" id="next_of_kin_fields">
			    <label for="next_of_kin">Next of Kin:</label>
			    <div class="next-of-kin">
			        <div class="form-row">
			            <div class="col">
			                <input type="text" class="form-control" name="next_of_kin[][IdCard]" placeholder="ID Card" required>
			            </div>
			            <div class="col">
			                <input type="text" class="form-control" name="next_of_kin[][Name]" placeholder="Name" required>
			            </div>
			            <div class="col">
			                <input type="text" class="form-control" name="next_of_kin[][Surname]" placeholder="Surname" required>
			            </div>
			            <div class="col">
			                <input type="text" class="form-control" name="next_of_kin[][ContactNumber1]" placeholder="Contact Number 1" required>
			            </div>
			            <div class="col">
			                <input type="text" class="form-control" name="next_of_kin[][ContactNumber2]" placeholder="Contact Number 2" >
			            </div>
			        </div>
			    </div>
			    <button type="button" class="btn btn-primary mt-2" id="add_next_of_kin">Add Next of Kin</button>
			</div>
			<hr>
			<label for="conditions">Condition :</label>
			<div class="conditions">
			    <div class="form-row">
			        <div class="col">
			            <input type="text" class="form-control" name="conditions[][name]" placeholder="Name" required>
			        </div>
			        <div class="col">
			            <input type="text" class="form-control" name="conditions[][notes]" placeholder="Notes">
			        </div>
			    </div>
			</div>
			<button type="button" class="btn btn-primary mb-3" id="add_condition">Add Condition</button>
			<hr>
			<label for="allergies">Allergies :</label>
			<div class="allergies">
			    <div class="form-row">
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][name]" placeholder="Name" required>
			        </div>
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][notes]" placeholder="Notes">
			        </div>
			    </div>
			</div>
			<button type="button" class="btn btn-primary mb-3" id="add_allergy">Add Allergy</button>
			<hr>
			<label for="medications">Medications :</label>
			<div class="medications">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="medications[][name]" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="medications[][notes]" placeholder="Notes">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="medications[][start_date]" placeholder="Start Date" required>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="medications[][end_date]" placeholder="End Date">
                    </div>
                </div>
            </div>

			<button type="button" class="btn btn-primary mb-3" id="add_medication">Add Medication</button>

			<div class="form-row mt-3">
			    <div class="col">
			        <button type="submit" class="btn btn-success">Save</button>
			        <a href="/patients" class="btn btn-secondary">Cancel</a>
			    </div>
			</div>



    </form>
</div>
<script>
    $(document).ready(function() {
        $('#IdCard').on('blur', function() {
            var idCard = $(this).val();
            if (idCard) {
                    $.ajax({
                    url: '/check-idcard',
                    type: 'POST',
                    data: {
                        IdCard: $('#IdCard').val(),
                        _token: '<?php echo e(csrf_token()); ?>' // CSRF tokenini ekleyin
                    },
                    success: function(response) {
                        // Başarılı yanıtı işleyin
                        $('#name').val(response.Name);
                        $('#surname').val(response.Surname);
                        $('#gender').val(response.Gender);
                        $('#dob').val(response.DateOfBirth);
                        $('#address').val(response.Address);
                        $('#postcode').val(response.Postcode);
                        $('#contact_number1').val(response.ContactNumber1);
                        $('#contact_number2').val(response.ContactNumber2);
                    },
                    error: function(xhr, status, error) {
                        // Hata durumunda işleyin
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Next of Kin
        var nextOfKinField = $('#next_of_kin_fields');
        var addNextOfKinButton = $('#add_next_of_kin');
        var nextOfKinWrapper = $('.next-of-kin');

        // Add Next of Kin
        $(addNextOfKinButton).click(function() {
            var nextOfKinHtml = `
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="next_of_kin[][IdCard]" placeholder="ID Card required">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="next_of_kin[][name]" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="next_of_kin[][surname]" placeholder="Surname" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="next_of_kin[][ContactNumber1]" placeholder="Contact Number 1" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="next_of_kin[][ContactNumber2]" placeholder="Contact Number 2">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-sm delete-next-of-kin">Remove</button>
                    </div>
                </div>
            `;
            $(nextOfKinWrapper).append(nextOfKinHtml);
        });

        // Delete Next of Kin
        $(nextOfKinWrapper).on('click', '.delete-next-of-kin', function() {
            $(this).closest('.form-row').remove();
        });
    });

    $(document).ready(function() {
        // Conditions
        var conditionsField = $('#conditions_fields');
        var addConditionButton = $('#add_condition');
        var conditionsWrapper = $('.conditions');

        // Add Condition
        $(addConditionButton).click(function() {
            var conditionHtml = `
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="conditions[][name]" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="conditions[][notes]" placeholder="Notes">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-sm delete-condition">Remove</button>
                    </div>
                </div>
            `;
            $(conditionsWrapper).append(conditionHtml);
        });

        // Delete Condition
        $(conditionsWrapper).on('click', '.delete-condition', function() {
            $(this).closest('.form-row').remove();
        });
    });

    $(document).ready(function() {
        // Alergies
        var allergiesField = $('#allergies_fields');
        var addAllergyButton = $('#add_allergy');
        var allergiesWrapper = $('.allergies');

        // Add Allergy
        $(addAllergyButton).click(function() {
            var allergyHtml = `
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="allergies[][name]" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="allergies[][notes]" placeholder="Notes">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-sm delete-allergy">Remove</button>
                    </div>
                </div>
            `;
            $(allergiesWrapper).append(allergyHtml);
        });

        // Delete Allergy
        $(allergiesWrapper).on('click', '.delete-allergy', function() {
            $(this).closest('.form-row').remove();
        });
    });

    $(document).ready(function() {
        // Medications
        var medicationsWrapper = $('.medications');
        var addMedicationButton = $('#add_medication');

        $(addMedicationButton).click(function() {
            var medicationHtml = `
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="medications[][name]" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="medications[][notes]" placeholder="Notes">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="medications[][start_date]" placeholder="Start Date" required>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="medications[][end_date]" placeholder="End Date">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger remove-medication">Remove</button>
                    </div>
                </div>
            `;
            $(medicationsWrapper).append(medicationHtml);
        });

        // Remove Medication
        $(medicationsWrapper).on('click', '.remove-medication', function() {
            $(this).closest('.form-row').remove();
        });
    });



</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel\ExtratikCaseStudy\resources\views/patients/add.blade.php ENDPATH**/ ?>