<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $icona->exists ? 'Modifica icona' : 'Nuova icona' }}
        </h2>
    </x-slot>

    <div class="container-fluid border py-4">
        <div class="card mb-4">
            <div class="card-body text-end">
                <a href="{{ route('icone.index') }}" class="btn btn-sm btn-outline-secondary">Indietro</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ $icona->exists ? route('icone.update', $icona) : route('icone.store') }}"
                      x-data="iconPicker(@js(old('classe', $icona->classe ?? 'fa-solid fa-calendar')), @js(old('nome', $icona->nome ?? '')))">
                    @csrf
                    @if($icona->exists)
                        @method('PATCH')
                        <p class="text-muted">Le modifiche saranno visibili anche negli eventi che utilizzano questa icona.</p>
                    @endif
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                        <input id="nome" name="nome" class="form-control" x-model="nome" value="{{ old('nome', $icona->nome) }}" maxlength="255" required>
                        @error('nome')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <fieldset class="mb-3">
                        <legend class="form-label" style="font-size: inherit;">Scegli un’icona <span class="text-danger">*</span></legend>
                        <p class="form-text mt-0">Cerca un simbolo e cliccalo per selezionarlo. Puoi cambiare liberamente il nome qui sopra.</p>
                        <div class="row g-2 mb-3">
                            <div class="col-md-8">
                                <label for="ricerca-icona" class="form-label">Cerca icona</label>
                                <input id="ricerca-icona" type="search" class="form-control" x-model="query" x-on:input="limit = 48"
                                       placeholder="Es. telefono, medico, auto, compleanno…" autocomplete="off" aria-controls="catalogo-icone">
                            </div>
                            <div class="col-md-4">
                                <label for="categoria-icona" class="form-label">Categoria</label>
                                <select id="categoria-icona" class="form-select" x-model="category" x-on:change="limit = 48" aria-controls="catalogo-icone">
                                    <option value="">Tutte le categorie</option>
                                    <template x-for="item in categories" :key="item">
                                        <option :value="item" x-text="item"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <p class="form-text" role="status" aria-live="polite" x-text="filtered.length + ' icone trovate'"></p>
                        <div id="catalogo-icone" class="border rounded p-2" style="max-height: 24rem; overflow-y: auto;">
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: .5rem;">
                                <template x-for="item in visible" :key="item.classe">
                                    <button type="button" class="btn d-flex flex-column align-items-center justify-content-center p-2"
                                            style="min-height: 90px; white-space: normal;"
                                            :class="classe === item.classe ? 'btn-primary' : 'btn-outline-secondary'"
                                            :aria-pressed="classe === item.classe" :aria-label="item.label"
                                            x-on:click="choose(item)">
                                        <span aria-hidden="true" class="mb-2"><i :class="item.classe + ' fa-fw'" style="font-size: 1.5rem;"></i></span>
                                        <span class="small" x-text="item.label"></span>
                                    </button>
                                </template>
                            </div>
                            <p class="text-muted p-3 mb-0" x-show="filtered.length === 0" x-cloak>
                                Nessuna icona trovata. Prova un altro termine o cambia categoria.
                            </p>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" x-show="filtered.length > limit" x-cloak x-on:click="limit += 48">
                            Mostra altre icone
                        </button>
                    </fieldset>
                    <div class="mb-4">
                        <span class="form-label d-block">Anteprima selezionata</span>
                        <div class="d-flex align-items-center gap-3 border rounded p-3" role="status" aria-live="polite">
                            <span aria-hidden="true">
                                <template x-for="value in [classe]" :key="value">
                                    <span><i :class="value" style="font-size: 2rem;"></i></span>
                                </template>
                            </span>
                            <span x-text="selectedLabel"></span>
                        </div>
                    </div>
                    <details class="mb-4" @if($errors->has('classe')) open @endif>
                        <summary>Altre icone / inserimento manuale</summary>
                        <p class="form-text">Questa selezione raccoglie i simboli più comuni. Per usarne un altro disponibile nel kit del sito, copia le classi dal
                            <a href="https://fontawesome.com/search" target="_blank" rel="noopener noreferrer">catalogo FontAwesome</a>.</p>
                        <label for="classe" class="form-label mt-2">Classi FontAwesome</label>
                        <input id="classe" name="classe" class="form-control" x-model="classe" value="{{ old('classe', $icona->classe ?? 'fa-solid fa-calendar') }}" maxlength="255" aria-describedby="classe-help">
                        <div id="classe-help" class="form-text">Ad esempio <code>fa-solid fa-phone</code>, senza codice HTML.</div>
                        @error('classe')<div class="text-danger">{{ $message }}</div>@enderror
                    </details>
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-outline-primary">{{ $icona->exists ? 'Modifica' : 'Inserisci' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
