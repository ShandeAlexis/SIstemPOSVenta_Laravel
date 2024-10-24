<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    public function documento(){
        return $this->belongsTo(Documento::class);
    }
}
