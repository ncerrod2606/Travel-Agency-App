<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacacion extends Model {

    protected $table = 'vacacion';

    protected $fillable = ['titulo', 'descripcion', 'precio', 'idtipo', 'pais'];

    function getPath(): string {
        $path = url('assets/img/noimage.jpg');
        $foto = $this->fotos->first();
        if($foto != null) {
            if (file_exists(storage_path('app/public') . '/' . $foto->ruta)) {
                $path = url('storage/' . $foto->ruta);
            } elseif (file_exists(public_path($foto->ruta))) {
                 $path = url($foto->ruta);
            }
        }
        return $path;
    }

    public function tipo(): BelongsTo {
        return $this->belongsTo('App\Models\Tipo', 'idtipo');
    }

    public function fotos(): HasMany {
        return $this->hasMany('App\Models\Foto', 'idvacacion');
    }

    public function comentarios(): HasMany {
        return $this->hasMany('App\Models\Comentario', 'idvacacion');
    }

    public function reservas(): HasMany {
        return $this->hasMany('App\Models\Reserva', 'idvacacion');
    }
}