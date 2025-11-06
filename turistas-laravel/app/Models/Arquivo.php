<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Arquivo extends Model
{
    use HasFactory;

    protected $table = 'arquivos';

    protected $fillable = [
        'prestador_id',
        'titulo',
        'descricao',
        'arquivo_path',
        'mime',
        'size',
        'status',
        'aprovado_em',
        'aprovado_por',
    ];

    protected $casts = [
        'aprovado_em' => 'datetime',
    ];

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function aprovadoPor()
    {
        return $this->belongsTo(User::class, 'aprovado_por');
    }

    // helper para obter URL pública (usando disk 'public')
    public function url()
    {
        return Storage::disk('public')->url($this->arquivo_path);
    }
}
