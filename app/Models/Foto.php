<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model {

    protected $table = 'foto';
    public $timestamps = false;

    protected $fillable = ['idvacacion', 'ruta'];

    public function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }
}
