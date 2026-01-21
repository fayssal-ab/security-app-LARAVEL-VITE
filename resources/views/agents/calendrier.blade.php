@extends('layouts.app')

@section('title', 'Mon planning')

@section('content')
<div class="container-fluid p-4">
    <h4 class="mb-4">
        <i class="fas fa-calendar-alt text-primary me-2"></i>
        Mon planning de sécurité
    </h4>
    <div id="calendar" style="min-height:650px;"></div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'),
        {
            initialView: 'timeGridWeek',
            locale: 'fr',
            events: "{{ route('agent.calendrier.events') }}",
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour'
            },
            eventContent: function(arg) {
                return {
                    html: `
                        <div class="fc-event-custom p-2">
                            <div class="fc-time fw-bold mb-1">
                                <i class="fas fa-clock me-1"></i>
                                ${arg.timeText}
                            </div>
                            <div class="fc-title fw-semibold">
                                <i class="fas fa-building me-1"></i>
                                ${arg.event.title}
                            </div>
                            <div class="fc-address d-flex align-items-start mt-1">
                                <i class="fas fa-map-marker-alt me-2 mt-1"></i>
                                <div class="address-text small">
                                    ${arg.event.extendedProps.adresse.replace(/\n/g, '<br>')}
                                </div>
                            </div>
                        </div>
                    `
                };
            }
        }
    );

    calendar.render();
});
</script>

<style>
.fc-event-custom {
    font-size: 13px;
    line-height: 1.4;
}

.fc-time {
    color: #1e3c72;
}

.fc-title {
    color: #1e293b;
}

.fc-address {
    color: #64748b;
}

.address-text {
    flex: 1;
}
</style>
@endsection