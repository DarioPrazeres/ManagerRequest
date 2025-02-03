<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'grupo_id'];

    public function user_Id()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function grupo_Id()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'id');
    }

    public function grupo(){
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    
}
