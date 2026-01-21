@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <h1 class="h2 fw-bold mb-4">
        <i class="fas fa-chart-line text-primary me-2"></i>
        Dashboard Admin
    </h1>

    {{-- ALERT ABSENCE --}}
    @if($absent > 0)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ $absent }} agent(s) absent(s) aujourd'hui
        </div>
    @endif

    {{-- STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Agents</p>
                        <h2 class="fw-bold mb-0">{{ $agentsCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-info">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Sites</p>
                        <h2 class="fw-bold mb-0">{{ $sitesCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-warning">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Plannings</p>
                        <h2 class="fw-bold mb-0">{{ $planningsCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Présences aujourd'hui</p>
                        <h2 class="fw-bold mb-0">{{ $todayPresences }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAPH + TABLE --}}
    <div class="row">

        {{-- GRAPH --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    <i class="fas fa-chart-pie me-2"></i>
                    Répartition des présences
                </div>
                <div class="card-body">
                    <canvas id="presenceChart"></canvas>
                </div>
            </div>
        </div>

        {{-- TABLE DERNIÈRES PRÉSENCES --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    <i class="fas fa-list me-2"></i>
                    Dernières présences
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Agent</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lastPresences as $presence)
                            <tr>
                                <td>{{ $presence->agent?->nom ?? '—' }}</td>
                                <td>{{ $presence->date }}</td>
                                <td>
                                    @if($presence->statut === 'present')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Présent
                                        </span>
                                    @elseif($presence->statut === 'retard')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>
                                            Retard
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>
                                            Absent
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
.stats-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
}
</style>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('presenceChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Présent', 'Retard', 'Absent'],
            datasets: [{
                data: [
                    {{ $present }},
                    {{ $retard }},
                    {{ $absent }}
                ],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection