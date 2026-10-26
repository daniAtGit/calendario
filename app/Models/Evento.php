<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    use HasUuids;

    protected $table="eventi";

    protected $fillable = [
        'persona_id',
        'icona_id',
        'descrizione',
        'start'
    ];

    protected $casts = [
        'start' => 'datetime'
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function icona(): BelongsTo
    {
        return $this->belongsTo(Icona::class);
    }
}
