<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuovo evento
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-end">
                        <a href="{{route('eventi.index')}}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Indietro
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card mb-4">
            <div class="row mt-3">
                <div class="col-1"></div>

                <div class="col-10">
                    <form method="post" action="{{route('eventi.store')}}">
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
                            <input type="datetime-local" name="start" class="form-control" required>
                        </div>

                        <div class="mb-3 text-end">
                            <input type="submit" class="btn btn-sm btn-outline-primary" value="Inserisci">
                        </div>
                    </form>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                //
            });
        </script>
    @stop
</x-app-layout>
