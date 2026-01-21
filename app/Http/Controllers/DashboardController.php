<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Site;
use App\Models\Planning;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        /* ================= ADMIN ================= */
        if ($user->role === 'admin') {

            // Statistiques globales
            $agentsCount = Agent::count();
            $sitesCount = Site::count();
            $planningsCount = Planning::count();

            // Présences aujourd’hui
            $todayPresences = Presence::whereDate('date', $today)
                ->where('statut', 'present')
                ->count();

            $todayAbsences = Presence::whereDate('date', $today)
                ->where('statut', 'absent')
                ->count();

            // Données graphique
            $present = Presence::whereDate('date', $today)
                ->where('statut', 'present')
                ->count();

            $retard = Presence::whereDate('date', $today)
                ->where('statut', 'retard')
                ->count();

            $absent = Presence::whereDate('date', $today)
                ->where('statut', 'absent')
                ->count();

            // Dernières présences
            $lastPresences = Presence::latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'agentsCount',
                'sitesCount',
                'planningsCount',
                'todayPresences',
                'todayAbsences',
                'present',
                'retard',
                'absent',
                'lastPresences'
            ));
        }

        /* ================= AGENT ================= */

        // Récupérer l’agent lié à l’utilisateur
        $agent = $user->agent;

        // Statut du jour
        $todayPresence = Presence::where('agent_id', $agent->id)
            ->whereDate('date', $today)
            ->first();

        // Stats personnelles (mois courant)
        $month = Carbon::now()->month;

        $presentCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'present')
            ->count();

        $absentCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'absent')
            ->count();

        $retardCount = Presence::where('agent_id', $agent->id)
            ->whereMonth('date', $month)
            ->where('statut', 'retard')
            ->count();

        // Prochain planning
        $nextPlanning = Planning::where('agent_id', $agent->id)
            ->whereDate('date', '>=', $today)
            ->orderBy('date')
            ->first();

        // Historique récent
        $lastPresences = Presence::where('agent_id', $agent->id)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.agent', compact(
            'todayPresence',
            'presentCount',
            'absentCount',
            'retardCount',
            'nextPlanning',
            'lastPresences'
        ));
    }

    /* ================= HISTORIQUE AGENT ================= */
    public function historiqueAgent()
    {
        $user = auth()->user();

        $presences = Presence::whereHas('agent', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('dashboard.historique-agent', compact('presences'));
    }
}