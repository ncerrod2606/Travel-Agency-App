<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model {

    protected $table = 'foto';
    public $timestamps = false;

    protected $fillable = ['idvacacion', 'ruta'];

    public function getPath(): string {
        $path = url('assets/img/noimage.jpg');
        if (file_exists(storage_path('app/public') . '/' . $this->ruta)) {
            $path = url('storage/' . $this->ruta);
        } elseif (file_exists(public_path($this->ruta))) {
             $path = url($this->ruta);
        }
        return $path;
    }

    public function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }
}
