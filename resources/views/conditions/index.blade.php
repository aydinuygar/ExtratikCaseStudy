@extends('layouts.app')

@section('content')
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
            @foreach($conditionsCount as $key => $value)
            <tr class="condition">
                <td><a href="/condition/{{  $key }}">{{  $key }}</a></td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
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

@endsection
