<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Persona extends Model
{
    use HasUuids, Notifiable;

    protected $table="persone";

    protected $fillable = [
        'nome',
        'colore',
        'email',
        'invio',
    ];

    protected $casts = [
        'invio' => 'boolean'
    ];

    public function eventi(): HasMany
    {
        return $this->hasMany(Evento::class);
    }

    public function scopeNotificabili()
    {
        return $this->where('invio', true);
    }
}
