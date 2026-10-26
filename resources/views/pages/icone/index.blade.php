<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Icone</h2>
    </x-slot>

    <div class="container-fluid border py-4">
        <div class="card mb-4">
            <div class="card-body text-end">
                <a href="{{ route('icone.create') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fa-solid fa-circle-plus" aria-hidden="true"></i> Nuova icona
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr><th>Icona</th><th>Nome</th><th>Classi FontAwesome</th><th>Azioni</th></tr>
                    </thead>
                    <tbody>
                        @forelse($icone as $icona)
                            <tr>
                                <td><i class="{{ $icona->classe }} fa-fw" aria-hidden="true"></i></td>
                                <td>{{ $icona->nome }}</td>
                                <td>{{ $icona->classe }}</td>
                                <td><a href="{{ route('icone.edit', $icona) }}" class="btn btn-sm btn-outline-secondary">Modifica</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Non ci sono ancora icone. Aggiungi la prima per usarla negli eventi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
