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
                           value="{{ $icona->id }}" @checked(old('icona_id', $selected) == $icona->id) required>
                    <label class="btn btn-outline-secondary" for="icona-{{ $icona->id }}">
                        <i class="{{ $icona->classe }} fa-fw me-1" aria-hidden="true"></i> {{ $icona->nome }}
                    </label>
                </div>
            @endforeach
        </div>
    @endif
    @error('icona_id')<div class="text-danger mt-1">{{ $message }}</div>@enderror
</fieldset>
