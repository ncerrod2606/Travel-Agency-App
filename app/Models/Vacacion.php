<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacacion extends Model {

    protected $table = 'vacacion';

    protected $fillable = ['titulo', 'descripcion', 'precio', 'idtipo', 'pais'];

    function getPath(): string {
        $path = url('assets/img/placeholder.jpg'); // Default placeholder
        $foto = $this->fotos->first();
        if($foto != null &&
                file_exists(storage_path('app/public') . '/' . $foto->ruta)) {
            $path = url('storage/' . $foto->ruta);
        }
        return $path;
    }

    //relación con el modelo Tipo
    function tipo(): BelongsTo {
        return $this->belongsTo('App\Models\Tipo', 'idtipo');
    }

    //relación con el modelo Foto
    function fotos(): HasMany {
        return $this->hasMany('App\Models\Foto', 'idvacacion');
    }

    //relación con el modelo Comentario
    function comentarios(): HasMany {
        return $this->hasMany('App\Models\Comentario', 'idvacacion');
    }

    //relación con el modelo Reserva
    function reservas(): HasMany {
        return $this->hasMany('App\Models\Reserva', 'idvacacion');
    }
}