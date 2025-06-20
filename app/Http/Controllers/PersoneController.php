<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PersoneController extends Controller
{
    public function index(): View
    {
        $persone = Persona::all()->sortBy('nome');
        return view('pages.persone.index', compact('persone'));
    }

    public function create(): View
    {
        return view('pages.persone.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required',
            'colore' => 'required',
            'email' => 'nullable|email:rfc,dns'
            ],
            [
            'nome.required' => 'Il nome è obbligatorio.',
            'colore.required' => 'Il colore è obbligatorio.',
            'email.email' => 'Email non valido.'
        ]);

        Persona::create([
            'nome' => $request->nome,
            'colore' => $request->colore,
            'email' => $request->email,
            'invio' => $request->invio
        ]);

        return redirect()->route('persone.index');
    }

    public function edit(Persona $persona): View
    {
        return view('pages.persone.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona): RedirectResponse
    {
        $request->validate([
            'nome' => 'required',
            'colore' => 'required',
            'email' => 'nullable|email:rfc,dns'
        ],
            [
                'nome.required' => 'Il nome è obbligatorio.',
                'colore.required' => 'Il colore è obbligatorio.',
                'email.email' => 'Email non valido.'
            ]);

        $persona->update([
            'nome' => $request->nome,
            'colore' => $request->colore,
            'email' => $request->email,
            'invio' => $request->invio
        ]);

        return redirect()->route('persone.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        dd($persona);
    }
}
