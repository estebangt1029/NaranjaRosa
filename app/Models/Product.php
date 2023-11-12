<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'referencia',
        'nombre',
        'cantidad',
        's',
        'm',
        'l',
        'xl',
        'xxl',
        'stock',
    ];

    public function entrada(): HasMany
    {
        return $this->hasMany(Entrada::class);
    }

    public function salida(): HasMany
    {
        return $this->hasMany(Salida::class);
    }
}
