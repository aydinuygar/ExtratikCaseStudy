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
                            <option value="{{ url('/patient/' . $_phd->id) }}"> {{$condition_name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $phd->patient->Name }} {{ $phd->patient->Surname }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Gender:</strong> {{ $phd->patient->Gender }}</p>
                    <p><strong>Date of Birth:</strong> {{ $phd->patient->DateOfBirth }}</p>
                    <p><strong>Address:</strong> {{ $phd->patient->Address }}</p>
                    <p><strong>Postcode:</strong> {{ $phd->patient->Postcode }}</p>
                    <p><strong>Contact Number 1:</strong> {{ $phd->patient->ContactNumber1 }}</p>
                    <p><strong>Contact Number 2:</strong> {{ $phd->patient->ContactNumber2 }}</p>
                </div>
                <div class="col-md-4 text-right">
                    @if($phd->patient->Gender == 'Male')
                        <img src="{{ asset('images/male_avatar.png') }}" class="rounded-circle mb-3" alt="MaleAvatar"style="width: 200px; ">
                    @elseif($phd->patient->Gender == 'Female')
                        <img src="{{ asset('images/female_avatar.png') }}" class="rounded-circle mb-3" alt="FemaleAvatar"style="width: 200px; ">
                    @endif
                </div>
            </div>

            <hr>

            <h6>Next of Kin:</h6>
            <div class="row">
                @foreach ($nextOfKins as $nextOfKin)
                    <div class="col-md-6">
                        <ul>
                            <li>Name: {{ $nextOfKin->Name }}</li>
                            <li>Surname: {{ $nextOfKin->Surname }}</li>
                            <li>Contact Number 1: {{ $nextOfKin->ContactNumber1 }}</li>
                            <li>Contact Number 2: {{ $nextOfKin->ContactNumber2 }}</li>
                        </ul>
                    </div>
                @endforeach
            </div> 

            <hr>

            <h6>Medical Information:</h6>
            <p><strong>Conditions:</strong></p>
            <ul>
                @foreach (json_decode($phd->medical->conditions) as $condition)
                <li>{{ $condition->name }} - {{ $condition->notes }}</li>
                @endforeach
            </ul>

            <p><strong>Allergies:</strong></p>
            <ul>
                @foreach (json_decode($phd->medical->alergies) as $allergy)
                <li>{{ $allergy->name }} - {{ $allergy->notes }}</li>
                @endforeach
            </ul>

            <p><strong>Medication:</strong></p>
            <ul>
                @foreach (json_decode($phd->medical->medication) as $medication)
                <li>{{ $medication->name }} - {{ $medication->notes }}</li>
                <li>{{ $medication->start_date }} - {{ $medication->end_date }}</li>
                <hr>
                @endforeach
            </ul>
        </div>
    </div>
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