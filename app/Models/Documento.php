<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    public function documento(){
        return $this->belongsTo(Documento::class);
    }
}
