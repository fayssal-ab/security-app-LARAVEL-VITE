@extends('layouts.app')

@section('title', 'Mon historique')

@section('content')
<div class="container-fluid px-4 py-4">

    <h2 class="fw-bold mb-4">
        <i class="fas fa-history text-primary me-2"></i>
        Mon historique de présence
    </h2>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="fas fa-calendar-day me-2"></i>Date</th>
                        <th><i class="fas fa-building me-2"></i>Site</th>
                        <th><i class="fas fa-info-circle me-2"></i>Statut</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($presences as $presence)
                    <tr>
                        <td>{{ $presence->date }}</td>
                        <td>{{ $presence->agent?->plannings?->first()?->site?->nom ?? '—' }}</td>
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
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>Aucun historique disponible</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $presences->links() }}
    </div>

</div>
@endsection