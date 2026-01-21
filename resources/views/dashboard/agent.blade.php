@extends('layouts.app')

@section('title', 'Dashboard Agent')

@section('content')
<div class="container-fluid px-4 py-4">

    <h1 class="h2 fw-bold mb-4">
        <i class="fas fa-user-shield text-primary me-2"></i>
        Dashboard Agent
    </h1>

    {{-- STATUT DU JOUR --}}
    <div class="alert
        @if(!$todayPresence) alert-secondary
        @elseif($todayPresence->statut === 'present') alert-success
        @elseif($todayPresence->statut === 'retard') alert-warning
        @else alert-danger
        @endif
    ">
        @if(!$todayPresence)
            <i class="fas fa-hourglass-half me-2"></i>
            Pas encore pointé aujourd'hui
        @elseif($todayPresence->statut === 'present')
            <i class="fas fa-check-circle me-2"></i>
            Vous êtes présent aujourd'hui
        @elseif($todayPresence->statut === 'retard')
            <i class="fas fa-exclamation-triangle me-2"></i>
            Vous êtes en retard aujourd'hui
        @else
            <i class="fas fa-times-circle me-2"></i>
            Vous êtes absent aujourd'hui
        @endif
    </div>

    {{-- STATS PERSONNELLES --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Présences (mois)</p>
                        <h3 class="fw-bold mb-0">{{ $presentCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-danger">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Absences</p>
                        <h3 class="fw-bold mb-0">{{ $absentCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="stats-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Retards</p>
                        <h3 class="fw-bold mb-0">{{ $retardCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- PROCHAIN PLANNING --}}
    @if($nextPlanning)
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">
                <i class="fas fa-calendar-check me-2"></i>
                Prochain planning
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="mb-1"><strong><i class="fas fa-building me-2"></i>Site :</strong></p>
                        <p>{{ $nextPlanning->site->nom ?? '—' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong><i class="fas fa-calendar-day me-2"></i>Date :</strong></p>
                        <p>{{ $nextPlanning->date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong><i class="fas fa-clock me-2"></i>Heure :</strong></p>
                        <p>{{ $nextPlanning->heure_debut }} - {{ $nextPlanning->heure_fin }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- HISTORIQUE RÉCENT --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            <i class="fas fa-history me-2"></i>
            Historique récent
        </div>
        <div class="card-body p-0">
            <table class="table mb-0 table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lastPresences as $presence)
                    <tr>
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