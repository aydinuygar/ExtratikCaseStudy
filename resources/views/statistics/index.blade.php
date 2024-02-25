@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Statistics</h2>

    <div class="row">
        <div class="col-md-6">
            <canvas id="genderChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="conditionChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    var genderData = {!! json_encode($genderCounts) !!};
    var conditionData = {!! json_encode($conditionsCount) !!};

    var ctxGender = document.getElementById('genderChart').getContext('2d');
    var genderChart = new Chart(ctxGender, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'Gender',
                data: [genderData.male, genderData.female],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Gender Distribution'
                }
            }
        }
    });

    var ctxCondition = document.getElementById('conditionChart').getContext('2d');
    var conditionChart = new Chart(ctxCondition, {
        type: 'bar',
        data: {
            labels: Object.keys(conditionData),
            datasets: [{
                label: 'Number of Patients',
                data: Object.values(conditionData),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Condition Distribution'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
