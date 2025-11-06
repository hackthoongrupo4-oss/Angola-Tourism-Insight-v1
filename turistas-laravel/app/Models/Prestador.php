<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    use HasFactory;

    protected $table = 'prestadors';

    protected $fillable = [
        'user_id',
     
        'contacto',
        'descricao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'prestador_id');
    }
}
