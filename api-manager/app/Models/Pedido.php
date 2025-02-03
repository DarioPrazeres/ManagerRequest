<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'total',
        'status',
        'dataCriacao',
        'dataAtualizacao',
        'solicitante_id',
        'grupo_id',
    ];

    // Relacionamento com Solicitante
    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }

    // Relacionamento com Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // Relacionamento com Material (através da tabela intermediária)
    public function materiais()
    {
        return $this->belongsToMany(Material::class, 'pedido_has_materiais')
                    ->withPivot('quantidade', 'subtotal')
                    ->withTimestamps();
    }
}
