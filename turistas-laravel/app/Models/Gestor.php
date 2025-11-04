<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'provincia_id',];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
