@extends('layouts.app')

@section('content')
<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Delete Patient</h2>
    </div>

    <form  action="{{ url('/patient/save') }}" method="post">
         @csrf
         	<input type="hidden" name="crud" value="delete">
            <input type="hidden" name="phd_id" value="{{Request::segment(3)}}">


            <div class="form-group">
                <label for="IdCard">IdCard:</label>
                <input type="text" class="form-control" id="IdCard" name="IdCard" value="{{ $phd->patient->IdCard }}" readonly required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $phd->patient->Name }}" readonly required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ $phd->patient->Surname }}" readonly required>
            </div>
       

			<div class="form-row mt-3">
			    <div class="col">
			        <button type="submit" class="btn btn-danger">Delete</button>
			        <a href="/patients/edit/{{Request::segment(3)}}" class="btn btn-secondary">Cancel</a>
			    </div>
			</div>



    </form>
</div>


@endsection



