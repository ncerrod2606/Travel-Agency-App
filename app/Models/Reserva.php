<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model {

    protected $table = 'reserva';
    public $timestamps = false;

    protected $fillable = ['iduser', 'idvacacion'];

    public function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }

    public function user(): BelongsTo {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}
