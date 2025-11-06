<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_turistas',
        'data',
        'nome_sugestao',
        'tipos_sugestoes',
        'user_id',
        'provincia_id',
    ];

    protected $casts = [
        'data' => 'array',
        'tipos_sugestoes' => 'array',
        'n_turistas' => 'integer',
    ];

    // relações
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
