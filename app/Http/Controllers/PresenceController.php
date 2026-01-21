<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Agent;
use App\Models\Planning;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PresenceController extends Controller
{
 


public function indexAgent()
{
    $agent = auth()->user()->agent;
    $now = Carbon::now();

    $plannings = Planning::where('agent_id', $agent->id)
        ->whereIn('date', [
            $now->toDateString(),
            $now->copy()->subDay()->toDateString(),
        ])
        ->get();

    $presences = Presence::where('agent_id', $agent->id)
    ->orderBy('date', 'desc')
    ->paginate(5);

    $presences->getCollection()->transform(function ($presence) use ($agent) {

    $planning = Planning::where('agent_id', $agent->id)
        ->where('date', '<=', $presence->date)
        ->orderBy('date', 'desc')
        ->first();

    return [
        'date'        => $presence->date,
        'statut'      => $presence->statut,
        'site_nom'    => $planning?->site?->nom ?? '—',
        'heure_debut' => $planning?->heure_debut,
        'heure_fin'   => $planning?->heure_fin,
    ];
    });

    $historique = $presences;
    $planningValide = null;
    $start = null;
    $end = null;

    foreach ($plannings as $planning) {

        $s = Carbon::parse($planning->date.' '.$planning->heure_debut);
        $e = Carbon::parse($planning->date.' '.$planning->heure_fin);

        if ($planning->heure_fin < $planning->heure_debut) {
            $e->addDay();
        }


        if ($now->between($s, $e)) {
            $planningValide = $planning;
            $start = $s;
            $end = $e;
            break;
        }
    }

    if (!$planningValide) {
        return view('agents.presence.index', [
            'available' => false,
            'message' => 'pas de pointage au moment.',
            'historique' => $historique

        ]);
    }

    $presence = Presence::where('agent_id', $agent->id)
        ->whereDate('date', $start->toDateString())
        ->first();

    return view('agents.presence.index', [
        'available' => true,
        'planning' => $planningValide,
        'presence' => $presence,
        'start' => $start,
        'historique' => $historique

    ]);
}



public function store(Request $request)
{
    $agent = auth()->user()->agent;
    $now = Carbon::now('Africa/Casablanca');

    $plannings = Planning::where('agent_id', $agent->id)->get();

    foreach ($plannings as $planning) {

        $start = Carbon::parse($planning->date.' '.$planning->heure_debut);
        $end   = Carbon::parse($planning->date.' '.$planning->heure_fin);

        if ($planning->heure_fin < $planning->heure_debut) {
            $end->addDay();
        }

        if ($now->between($start, $end)) {

            if (Presence::where('agent_id', $agent->id)
                ->whereDate('date', $start->toDateString())
                ->exists()) {
                return back()->with('error', 'Pointage déjà effectué.');
            }

            $limit = $start->copy()->addMinutes(15);
            $statut = $now->greaterThan($limit) ? 'retard' : 'present';

            Presence::create([
                'agent_id' => $agent->id,
                'date' => $start->toDateString(),
                'statut' => $statut
            ]);

            return back()->with('success', "Pointage enregistré : $statut");
        }
    }

    return back()->with('error', 'Aucune affectation en cours.');
}




//admin

public function adminIndex(Request $request)
{
    $presences = Presence::with([
            'agent',
            'agent.plannings.site'
        ])

        ->when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {

                $q->whereHas('agent', function ($a) use ($request) {
                    $a->where('nom', 'LIKE', '%' . $request->search . '%');
                })

                ->orWhereHas('agent.plannings.site', function ($s) use ($request) {
                    $s->where('nom', 'LIKE', '%' . $request->search . '%');
                });
            });
        })

        ->when($request->date, function ($query) use ($request) {
            $query->whereDate('date', $request->date);
        })

        ->orderBy('date', 'desc')

        ->paginate(5)
        ->withQueryString();

    return view('agents.presence.admin.index', compact('presences'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:present,absent,retard',
        ]);

        $presence = Presence::findOrFail($id);
        $presence->update([
            'statut' => $request->statut,
        ]);

        return back()->with('success', 'Statut mis à jour');
    }
}
