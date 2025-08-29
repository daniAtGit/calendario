<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Persona;
use App\Notifications\EventoInserito;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class FullCalendarController extends Controller
{
    public function events(Request $request): JsonResponse
    {
        $eventi = [];
        $events = Evento::all();

        foreach ($events as $i => $event) {
            //$startTime = Carbon::parse($event->start)->format('H:i');
            $eventi[$i] = [
                'id' => $event->id,
                //'title' => $event->descrizione.' '.$startTime,
                'title' => $event->descrizione,
                'start' => $event->start->format('Y-m-d H:i:s'),
                'url' => route('evento.modifica', ['id' => $event->id]),
                'backgroundColor' => $event->persona->colore
            ];
        }

        return response()->json($eventi);
    }

    public function create($data = null): View
    {
        $data = !is_null($data) ? $data : "";
        $persone = Persona::all()->sortBy('nome');
        return view('pages.calendario.create', compact('persone','data'));
    }

    public function store(Request $request): RedirectResponse
    {
        $persona = Persona::find($request->persona);
        $evento = $persona->eventi()->create([
            'descrizione' => $request->descrizione,
            'start' => Carbon::parse($request->start)
        ]);

//        foreach(Persona::notificabili()->get() as $personaNotificabile) {
//            $personaNotificabile->notify(new EventoInserito($evento));
//        }

        return redirect('/');
    }

    public function edit($id): View
    {
        $evento = Evento::find($id);
        $persone = Persona::all()->sortBy('nome');
        return view('pages.calendario.edit', compact('evento','persone'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $evento = Evento::find($id);

        $evento->update([
            'persona_id' => $request->persona,
            'descrizione' => $request->descrizione,
            'start' => Carbon::parse($request->start)
        ]);

        return redirect('/');
    }

    public function destroy($id): RedirectResponse
    {
        $evento = Evento::find($id);
        $evento->delete();

        return redirect('/');
    }
}
