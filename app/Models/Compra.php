<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ['user_id','plantilla_id','precio'];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con plantilla
    public function plantilla()
    {
        return $this->belongsTo(Plantilla::class);
    }
}