@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="form-group">
                    <select id="phd_select" class="form-control">
                        @foreach($phds as $_phd)
                            @php
                                $condition_name = json_decode($_phd->medical->conditions)[0]->name;
                            @endphp
                            <option value="{{ url('/patient/edit/' . $_phd->id) }}"> {{$condition_name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Edit Patient Health Data</h2>
        <a href="{{ url('patient/delete/' . Request::segment(3)) }}" class="btn btn-danger">Delete Patient</a>
    </div>

    <form  action="{{ url('/patient/save') }}" method="post">
         @csrf
         	<input type="hidden" name="crud" value="edit">
            <input type="hidden" name="phd_id" value="{{Request::segment(3)}}">


            <div class="form-group">
                <label for="IdCard">IdCard:</label>
                <input type="text" class="form-control" id="IdCard" name="IdCard" value="{{ $phd->patient->IdCard }}" readonly required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $phd->patient->Name }}" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ $phd->patient->Surname }}" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required >
                    <option @if($phd->patient->Gender == 'Male') selected @endif value="Male">Male</option>
                    <option @if($phd->patient->Gender == 'Female') selected @endif value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ $phd->patient->DateOfBirth }}" required >
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $phd->patient->Address }}" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $phd->patient->Postcode }}" required>
            </div>
            <div class="form-group">
                <label for="contact_number1">Contact Number 1:</label>
                <input type="text" class="form-control" id="contact_number1" name="contact_number1" value="{{ $phd->patient->ContactNumber1 }}" required>
            </div>
            <div class="form-group">
                <label for="contact_number2">Contact Number 2:</label>
                <input type="text" class="form-control" id="contact_number2" name="contact_number2" value="{{ $phd->patient->ContactNumber2 }}" >
            </div>

            <!-- Next of Kin -->
            <div class="form-group" id="next_of_kin_fields">
                <label for="next_of_kin">Next of Kin:</label>
                @foreach ($nextOfKins as $nextOfKin)
    			    <div class="next-of-kin">
    			        <div class="form-row">
    			            <div class="col">
    			                <input type="text" class="form-control" value="{{ $nextOfKin->IdCard }}" name="next_of_kin[][IdCard]" placeholder="ID Card" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="{{ $nextOfKin->Name }}" name="next_of_kin[][Name]" placeholder="Name" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="{{ $nextOfKin->Surname }}" name="next_of_kin[][Surname]" placeholder="Surname" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="{{ $nextOfKin->ContactNumber1 }}" name="next_of_kin[][ContactNumber1]" placeholder="Contact Number 1" required>
    			            </div>
    			            <div class="col">
    			                <input type="text" class="form-control" value="{{ $nextOfKin->ContactNumber2 }}" name="next_of_kin[][ContactNumber2]" placeholder="Contact Number 2" >
    			            </div>
    			        </div>
    			    </div>
                @endforeach
            </div>
			<hr>
			<label for="conditions">Condition :</label>
			<div class="conditions">
                @foreach (json_decode($phd->medical->conditions) as $condition)
    			    <div class="form-row">
    			        <div class="col">
    			            <input type="text" class="form-control" name="conditions[][name]" value="{{ $condition->name }}" placeholder="Name" required>
    			        </div>
    			        <div class="col">
    			            <input type="text" class="form-control" name="conditions[][notes]" value="{{ $condition->notes }}" placeholder="Notes">
    			        </div>
    			    </div>
                @endforeach
			</div>
			<hr>
			<label for="allergies">Allergies :</label>
			<div class="allergies">
                 @foreach (json_decode($phd->medical->alergies) as $allergy)
			    <div class="form-row">
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][name]" value="{{ $allergy->name }} " placeholder="Name" required>
			        </div>
			        <div class="col">
			            <input type="text" class="form-control" name="allergies[][notes]" value="{{ $allergy->notes }} " placeholder="Notes">
			        </div>
			    </div>
                @endforeach
			</div>
			<hr>
			<label for="medications">Medications :</label>
			<div class="medications">
                @foreach (json_decode($phd->medical->medication) as $medication)
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" name="medications[][name]" value="{{ $medication->name }}" placeholder="Name" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="medications[][notes]" value="{{ $medication->notes }}" placeholder="Notes">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="medications[][start_date]" value="{{ $medication->start_date }}" placeholder="Start Date" required>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="medications[][end_date]" value="{{ $medication->end_date }}" placeholder="End Date">
                        </div>
                    </div>
                @endforeach
            </div>


			<div class="form-row mt-3">
			    <div class="col">
			        <button type="submit" class="btn btn-primary">Edit</button>
			        <a href="/patients" class="btn btn-secondary">Cancel</a>
			    </div>
			</div>



    </form>
</div>


@endsection
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


