<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model
{
    protected $table = 'comentario';
    
    protected $fillable = ['iduser', 'idvacacion', 'texto'];

    public function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }

    public function user(): BelongsTo {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}