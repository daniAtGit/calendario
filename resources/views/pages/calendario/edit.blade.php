<x-app-layout>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <a href="{{env('APP_URL')}}">
                            <i class="fa fa-2x fa-calendar"></i>
                        </a>
                    </div>
                </header>

                <main>
                    <div class="row mt-3">
                        <div class="col-1"></div>

                        <div class="col-10">
                            <div class="mb-3 text-end">
                                <input type="button" class="btn btn-sm btn-outline-secondary" value="< Indietro" id="indietro">
                                <button class="btn btn-sm btn-outline-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'conferma')">
                                    <i class="fa fa-trash"></i> Elimina
                                </button>
                            </div>


                            <form method="post" action="{{route('evento.update', $evento->id)}}">
                                @csrf

                                <div class="mb-3">
                                    <label for="persona" class="form-label">Persona <span class="text-danger">*</span></label>
                                    <select name="persona" class="form-control" required>
                                        @foreach($persone as $persona)
                                            <option value="{{$persona->id}}" @selected($persona->id == $evento->persona_id)>{{$persona->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="descrizione" class="form-label">Descrizione <span class="text-danger">*</span></label>
                                    <textarea name="descrizione" class="form-control mb-3" rows="5" required>{{$evento->descrizione}}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="start" class="form-label">Giorno/Ora <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start" class="form-control" value="{{$evento->start}}" required>
                                </div>

                                <div class="mb-3 text-end">
                                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Modifica">
                                </div>
                            </form>
                        </div>

                        <div class="col-1"></div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <x-modal name="conferma" focusable>
        <form method="post" action="{{ route('evento.delete', ['id' => $evento->id]) }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                Cancellazione evento
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-left">
                Procedo alla cancellazione di questo evento dal calendario?
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Chiudi
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Elimina
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    @section('scripts')
        <script>
            $('#indietro').on('click', function() {
                window.history.back();
            });
        </script>
    @stop
</x-app-layout>
