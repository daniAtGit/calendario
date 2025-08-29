<x-app-layout>
{{--<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">--}}
    <div>

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
                            <form method="post" action="{{route('evento.store')}}">
                                @csrf

                                <div class="mb-3">
                                    <label for="persona" class="form-label">Persona <span class="text-danger">*</span></label>
                                    <select name="persona" class="form-control" required>
                                        @foreach($persone as $persona)
                                            <option value="{{$persona->id}}">{{$persona->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="descrizione" class="form-label">Descrizione <span class="text-danger">*</span></label>
                                    <textarea name="descrizione" class="form-control mb-3" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="start" class="form-label">Giorno/Ora <span class="text-danger">*</span></label>
                                    <input type="date" name="start" class="form-control" value="{{$data}}" required>
                                </div>

                                <div class="mb-3 text-end">
                                    <input type="button" class="btn btn-sm btn-outline-secondary" value="< Indietro" id="indietro">
                                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Inserisci">
                                </div>
                            </form>
                        </div>

                        <div class="col-1"></div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $('#indietro').on('click', function() {
                window.history.back();
            });
        </script>
    @stop
</x-app-layout>
