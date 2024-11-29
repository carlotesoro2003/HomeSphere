@extends('layouts.layout')

@section('title', 'Statistics')

@section('content')
<h1 class="text-4xl font-bold text-center mb-6">My Statistics</h1>

<div>
    @if(session()->has('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif
</div>

<!-- Stats Section -->
<div class="stats shadow-lg mb-6 p-4">
    <!-- Total Properties -->
    <div class="stat">
        <div class="stat-figure text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4.5a2.5 2.5 0 015 0V16a2.5 2.5 0 01-5 0V4.5zm6.5 10a2.5 2.5 0 015 0V16a2.5 2.5 0 01-5 0v-1.5zM21 4.5a2.5 2.5 0 015 0V16a2.5 2.5 0 01-5 0V4.5z"></path>
            </svg>
        </div>
        <div class="stat-title">Total Properties</div>
        <div class="stat-value text-primary">{{ $totalProperties }}</div>
        <div class="stat-desc">Total number of properties listed</div>
    </div>

    <!-- Average Price -->
    <div class="stat">
        <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10"></path>
            </svg>
        </div>
        <div class="stat-title">Average Price</div>
        <div class="stat-value text-secondary">${{ number_format($averagePrice, 2) }}</div>
        <div class="stat-desc">Average price of all properties</div>
    </div>

    <!-- Properties with Wifi -->
    <div class="stat">
        <div class="stat-figure text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 1C6.48 1 2 5.48 2 10s4.48 9 10 9 10-4.48 10-9-4.48-9-10-9zm0 2c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"></path>
            </svg>
        </div>
        <div class="stat-title">Properties with Wifi</div>
        <div class="stat-value text-green-500">{{ $propertiesWithWifi }}</div>
        <div class="stat-desc">Properties that offer Wi-Fi</div>
    </div>
</div>

<!-- Chart Section: Display properties' data visually -->
<div class="card bg-base-100 shadow-xl p-6 mb-6">
    <h2 class="text-2xl font-bold text-center mb-4">Property Statistics Overview</h2>
    <canvas id="propertyChart"></canvas>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('propertyChart').getContext('2d');
    var propertyChart = new Chart(ctx, {
        type: 'bar', // Bar chart type
        data: {
            labels: ['Total Properties', 'Average Price', 'Properties with Wifi'],
            datasets: [{
                label: 'Property Stats',
                data: [
                    {{ $totalProperties }},
                    {{ $averagePrice }},
                    {{ $propertiesWithWifi }}
                ],
                backgroundColor: ['rgba(56, 189, 248, 0.5)', 'rgba(34, 197, 94, 0.5)', 'rgba(248, 113, 113, 0.5)'],
                borderColor: ['rgb(56, 189, 248)', 'rgb(34, 197, 94)', 'rgb(248, 113, 113)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw.toLocaleString(); // Formatting tooltip labels
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString(); // Formatting y-axis values
                        }
                    }
                }
            }
        }
    });
</script>