@extends('layouts.app')

@section('content')
    <div class="jumbotron">
      <h1 class="display-4">Welcome!</h1>
      <p class="lead">Welcome to the Patient Portal. This platform allows patients to manage their information and track their health conditions.</p>
      <hr class="my-4">
      <p>To get started, please click the button below.</p>
      <a class="btn btn-primary btn-lg" href="/patients" role="button">Go to Portal</a>
@endsection
