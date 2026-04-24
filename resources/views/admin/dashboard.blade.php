@extends('layouts.admin')

@section('styles')
    <style>
        .stats-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
        }

        .stats-card p {
            font-size: 1rem;
            margin: 5px 0 0 0;
            opacity: 0.9;
        }

        .stats-card i {
            font-size: 3rem;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .bg-cyan {
            background-color: #17a2b8;
        }

        .bg-green {
            background-color: #28a745;
        }

        .bg-orange {
            background-color: #ffc107;
            color: #333 !important;
        }

        .bg-red {
            background-color: #dc3545;
        }

        .sales-chart-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sales-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sales-header h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .sales-total {
            font-size: 2rem;
            font-weight: 800;
            margin: 10px 0;
        }

        .sales-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row">
                <!-- Total Orders -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card bg-cyan position-relative">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>

                <!-- Total Partners -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card bg-green position-relative">
                        <h3>{{ $totalPartners }}</h3>
                        <p>Total Partners</p>
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>

                <!-- Total Contacts -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card bg-orange position-relative">
                        <h3>{{ $totalContacts }}</h3>
                        <p>Total Contacts</p>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card bg-red position-relative">
                        <h3>${{ number_format($totalRevenue, 2) }}</h3>
                        <p>Total Revenue</p>
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="sales-chart-container">
                        <div class="sales-header">
                            <div>
                                <h4>Sales</h4>
                                <div class="sales-total">${{ number_format($totalRevenue, 2) }}</div>
                                <div class="sales-subtitle">Sales Over Time</div>
                            </div>
                        </div>
                        <canvas id="salesChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesData = @json($salesData);

        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales ($)',
                    data: salesData,
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 1,
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return '$' + context.parsed.y.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection