<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Agent;
use App\Models\Site;

class PlanningController extends Controller
{
public function index(Request $request)
{
    $plannings = Planning::with(['agent', 'site'])

        ->when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('agent', function ($a) use ($request) {
                    $a->where('nom', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('site', function ($s) use ($request) {
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

    return view('plannings.index', compact('plannings'));
}

    public function create()
    {
        $agents = Agent::select('id', 'nom')->get();
        $sites  = Site::select('id', 'nom')->get();

        return view('plannings.create',compact('agents','sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        Planning::create($request->all());

        return redirect('/plannings');
    }
    public function destroy($id)
    {
        $planning = Planning::findOrFail($id);
        $planning->delete();

        return redirect('/plannings');
    }
    public function edit($id)
    {
        $planning = Planning::findOrFail($id);
        $agents = Agent::select('id', 'nom')->get();
        $sites  = Site::select('id', 'nom')->get();
        return view('plannings.edit', compact('planning','agents','sites'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
        ]);

        $planning = Planning::findOrFail($id);
        $planning->update($request->all());

        return redirect('/plannings');
     
    }

     public function index2()
    {
        return view('agents.calendrier');
    }

public function events()
{
    $agent = auth()->user()->agent;

    if (!$agent) {
        return response()->json([]);
    }

    $plannings = Planning::with('site')
        ->where('agent_id', $agent->id)
        ->get();

    $events = $plannings->map(function ($p) {
    return [
        'title' => $p->site->nom,
        'start' => $p->date . 'T' . $p->heure_debut,
        'end'   => $p->date . 'T' . $p->heure_fin,
        'extendedProps' => [
            'adresse' => $p->site->adresse,
        ],
    ];
});


    return response()->json($events);
}



}