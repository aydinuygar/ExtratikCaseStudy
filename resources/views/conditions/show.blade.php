@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Patients with {{ $condition }}</h2>
    <div class="row">
        @foreach($phds as $phd)
        <div class="col-md-4 mb-4 patient">
            <div class="card">
                <div class="card-body text-center">
                    @if($phd->patient->Gender == 'Male')
                        <img src="{{ asset('images/male_avatar.png') }}" class="rounded-circle mb-3" alt="MaleAvatar" style="width: 100px; ">
                    @elseif($phd->patient->Gender == 'Female')
                        <img src="{{ asset('images/female_avatar.png') }}" class="rounded-circle mb-3" alt="FemaleAvatar" style="width: 100px; ">
                    @endif
                    <h5 class="card-title">{{ $phd->patient->Name }} {{ $phd->patient->Surname }}</h5>
                    <p class="card-text">{{ $phd->patient->Gender }}</p>
                    <a href="/patient/{{ $phd->id }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
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

@endsection
