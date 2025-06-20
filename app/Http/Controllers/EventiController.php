<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventiController extends Controller
{
    public function index(): View
    {
        $eventi = Evento::all();
        return view('pages.eventi.index', compact('eventi'));
    }

    public function create(): View
    {
        $persone = Persona::all()->sortBy('nome');
        return view('pages.eventi.create', compact('persone'));
    }

    public function store(Request $request): RedirectResponse
    {
        $persona = Persona::find($request->persona);
        $evento = $persona->eventi()->create([
            'descrizione' => $request->descrizione,
            'start' => Carbon::parse($request->start)
        ]);

        return redirect()->route('eventi.index');
    }

    public function edit(Evento $evento): View
    {
        $persone = Persona::all()->sortBy('nome');
        return view('pages.eventi.edit', compact('evento','persone'));
    }

    public function update(Request $request, Evento $evento): RedirectResponse
    {
        $evento->update([
            'persona_id' => $request->persona,
            'descrizione' => $request->descrizione,
            'start' => Carbon::parse($request->start)
        ]);

        return redirect()->route('eventi.index');
    }

    public function destroy(Evento $evento): RedirectResponse
    {
        $evento->delete();
        return redirect()->route('eventi.index');
    }
}
