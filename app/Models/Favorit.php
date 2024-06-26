<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    use HasFactory;

    protected $table = 'favorit';
    protected $fillable = [
        'id_favorit',
        'pembeli_id',
        'produk_id'
    ];
}
