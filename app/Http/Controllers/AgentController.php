<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AgentController extends Controller
{
public function index(Request $request)
{
    $agents = Agent::query()

        ->when($request->search, function ($query) use ($request) {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        })

        ->paginate(5)
        ->withQueryString();

    return view('agents.index', compact('agents'));
}
public function create()
{
    return view('agents.create'); 
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'email' =>'required',
        'password'=>'required',
        'telephone' => 'required',
        'adresse' => 'required',
    ]);

    User::create([
        'name'=>$request->nom,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'role'=>'agent',
    ]);
    $user = User::where('email',$request->email)->first();
    Agent::create([
        'nom' => $request->nom,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'user_id' => $user->id,
    ]);

    return redirect('/agents');
}
   public function destroy($id)
{
    $agent = Agent::findOrFail($id);

    $userId = $agent->user_id;

    $agent->delete();

    User::where('id', $userId)->delete();

    return redirect('/agents')->with('success', 'Agent supprimé avec succès');
}

public function edit($id)
{
    $agent = Agent::findOrFail($id);
    return view('agents.edit', compact('agent'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required',
        'telephone' => 'required',
        'adresse' => 'required',
    ]);

    $agent = Agent::findOrFail($id);
    $agent->update([
        'nom' => $request->nom,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    return redirect('/agents');
}
}