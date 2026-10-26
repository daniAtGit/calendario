<?php

namespace App\Http\Controllers;

use App\Models\Icona;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IconeController extends Controller
{
    public function index(): View
    {
        return view('pages.icone.index', ['icone' => Icona::orderBy('nome')->get()]);
    }

    public function create(): View
    {
        return view('pages.icone.form', ['icona' => new Icona]);
    }

    public function store(Request $request): RedirectResponse
    {
        Icona::create($this->validated($request));

        return redirect()->route('icone.index');
    }

    public function edit(Icona $icona): View
    {
        return view('pages.icone.form', compact('icona'));
    }

    public function update(Request $request, Icona $icona): RedirectResponse
    {
        $icona->update($this->validated($request));

        return redirect()->route('icone.index');
    }

    private function validated(Request $request): array
    {
        $request->merge(['classe' => preg_replace('/\s+/', ' ', trim((string) $request->input('classe')))]);

        return $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'classe' => ['required', 'string', 'max:255', 'regex:/\Afa-(?:solid|regular|brands|light|thin|duotone|sharp)(?: fa-[a-z0-9]+(?:-[a-z0-9]+)*){1,3}\z/'],
        ], [
            'nome.required' => 'Il nome è obbligatorio.',
            'classe.required' => 'La classe FontAwesome è obbligatoria.',
            'classe.regex' => 'Inserisci le classi FontAwesome, ad esempio fa-solid fa-phone, senza codice HTML.',
        ]);
    }
}
