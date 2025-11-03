<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSugestao extends Model
{
    use HasFactory;

    protected $fillable = ['sugestao_id', 'descricao'];

    public function sugestao()
    {
        return $this->belongsTo(Sugestao::class);
    }
}
