@props(['icone', 'selected' => null])

<fieldset class="mb-3">
    <legend class="form-label" style="font-size: inherit;">Icona <span class="text-danger">*</span></legend>
    @if($icone->isEmpty())
        <p class="text-muted">Non ci sono icone disponibili. Aggiungi un’icona dalla sezione Icone prima di salvare l’evento.</p>
        @auth
            <a href="{{ route('icone.create') }}" target="_blank" rel="noopener noreferrer">Nuova icona</a>
            <span class="form-text">Dopo averla aggiunta, ricarica questa pagina.</span>
        @endauth
        <select name="icona_id" class="form-select mt-2" aria-label="Icona" required>
            <option value="">Nessuna icona disponibile</option>
        </select>
    @else
        <div class="d-flex flex-wrap gap-2">
            @foreach($icone as $icona)
                <div>
                    <input type="radio" class="btn-check" name="icona_id" id="icona-{{ $icona->id }}"
                           value="{{ $icona->id }}" aria-label="{{ $icona->nome }}" @checked(old('icona_id', $selected) == $icona->id) required>
                    <label class="btn btn-outline-secondary d-inline-flex align-items-center justify-content-center p-0"
                           style="width: 2.5rem; height: 2.5rem;" for="icona-{{ $icona->id }}" title="{{ $icona->nome }}">
                        <i class="{{ $icona->classe }} fa-fw" aria-hidden="true"></i>
                    </label>
                </div>
            @endforeach
        </div>
    @endif
    @error('icona_id')<div class="text-danger mt-1">{{ $message }}</div>@enderror
</fieldset>
