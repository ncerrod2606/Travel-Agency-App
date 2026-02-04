<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model {

    protected $table = 'reserva';
    public $timestamps = false; // Prompt only asked for id, iduser, idvacacion. No timestamps listed, but usually bookings have them. I'll disable unless specified. Actually prompt says "timestamps" for VACACION, COMENTARIO. Reserved doesn't list it.

    protected $fillable = ['iduser', 'idvacacion'];

    function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }

    function user(): BelongsTo {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}
