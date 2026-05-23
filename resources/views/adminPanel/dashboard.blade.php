@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <!-- Welcome Header -->
    <div class="mb-4">
        <h3 class="fw-semibold">Welcome back, Linda!</h3>
        <p class="text-muted">You have 24 new messages and 5 new notifications.</p>
    </div>

    <div class="row g-4">
        <!-- Stats Cards -->
        <div class="col-lg-3 col-md-6 ">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-muted">Total Earnings</h6>
                        <h4 class="mb-0">$24.300</h4>
                        <span class="percentage-up">8.35% More earnings than usual</span>
                    </div>
                    <div class="stats-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">

            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-muted">Total Earnings</h6>
                        <h4 class="mb-0">$24.300</h4>
                        <span class="percentage-up">8.35% More earnings than usual</span>
                    </div>
                    <div class="stats-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-muted">Visitors Today</h6>
                        <h4 class="mb-0">17.212</h4>
                        <span class="percentage-up">5.50% More visitors than usual</span>
                    </div>
                    <div class="stats-icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-muted">Pending Orders</h6>
                        <h4 class="mb-0">43</h4>
                        <span class="percentage-down">-4.25% Less orders than usual</span>
                    </div>
                    <div class="stats-icon">
                        <i class="bi bi-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-4">
        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 fw-semibold text-primary">Recent Movement</h6>

                </div>
                <div class="chart-placeholder">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">📈 y = sin(x)</h5>
                        </div>
                        <div class="card-body">
                            <!-- Chart Canvas -->
                            <canvas id="myChart" class="w-100" style="height:250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card browser-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="browser-title">Browser Usage</span>
                    <i class="bi bi-arrow-clockwise text-secondary"></i>
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <canvas id="browserChart" style="max-height: 200px;"></canvas>
                </div>

                <div>
                    <div class="d-flex align-items-center stat-row border-bottom">
                        <span class="legend-color" style="background-color:#4285F4"></span>
                        <span class="me-auto">:contentReference[oaicite:1]{index=1}</span>
                        <strong>4401</strong>
                    </div>
                    <div class="d-flex align-items-center stat-row border-bottom">
                        <span class="legend-color" style="background-color:#FF9500"></span>
                        <span class="me-auto">:contentReference[oaicite:2]{index=2}</span>
                        <strong>4003</strong>
                    </div>
                    <div class="d-flex align-items-center stat-row">
                        <span class="legend-color" style="background-color:#DB4437"></span>
                        <span class="me-auto">:contentReference[oaicite:3]{index=3}</span>
                        <strong>1589</strong>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row g-4 mt-4">
        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
            <div class="card p-3 w-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 fw-semibold text-primary">Latest Projects</h6>

                </div>


                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-xl-table-cell">Start Date</th>
                                <th class="d-none d-xl-table-cell">End Date</th>
                                <th>Status</th>
                                <th class="d-none d-md-table-cell">Assignee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Project Apollo</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td class="d-none d-md-table-cell">Carl Jenkins</td>
                            </tr>
                            <tr>
                                <td>Project Fireball</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td class="d-none d-md-table-cell">Bertha Martin</td>
                            </tr>
                            <tr>
                                <td>Project Hades</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td class="d-none d-md-table-cell">Stacie Hall</td>
                            </tr>
                            <tr>
                                <td>Project Nitro</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-warning">In progress</span></td>
                                <td class="d-none d-md-table-cell">Carl Jenkins</td>
                            </tr>
                            <tr>
                                <td>Project Phoenix</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td class="d-none d-md-table-cell">Bertha Martin</td>
                            </tr>
                            <tr>
                                <td>Project Romeo</td>
                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td class="d-none d-md-table-cell">Ashley Briggs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="col-12 col-lg-4 col-xxl-3 d-flex">
            <div class="card p-3 w-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 fw-semibold text-primary">Monthly Sales</h6>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <canvas id="chartjs-dashboard-bar" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection