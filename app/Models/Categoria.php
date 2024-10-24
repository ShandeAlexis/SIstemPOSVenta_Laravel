<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    public function producto(){
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }
    public function caracteristica(){
        return $this->belongsTo(Caracteristica::class);
    }
}
