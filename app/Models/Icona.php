<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Icona extends Model
{
    use HasUuids;

    protected $table = 'icone';

    protected $fillable = ['nome', 'classe'];

    public function eventi(): HasMany
    {
        return $this->hasMany(Evento::class);
    }
}
