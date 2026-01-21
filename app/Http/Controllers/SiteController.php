<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends controller
{

 public function index(Request $request)
{
    $sites = Site::query()
        ->when($request->search, function ($query) use ($request) {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        })
        ->paginate(5)
        ->withQueryString();

    return view('sites.index', compact('sites'));
}

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
        ]);

        Site::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
        ]);

        return redirect('/sites');
    }
    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();

        return redirect('/sites');
    }
    public function edit($id)
    {
        $site = Site::findOrFail($id);
        return view('sites.edit', compact('site'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
        ]);

        $site = Site::findOrFail($id);
        $site->nom = $request->nom;
        $site->adresse = $request->adresse;
        $site->save();

        return redirect('/sites')->with('success', 'Site mis à jour avec succès');
    }
}