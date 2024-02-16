<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbObat extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "tbobat";
    protected $keyType = 'string';
    protected $primaryKey = "idObat";

    protected $fillable = [
        'idObat',
        'namaObat',
        'stok',
        'caraPakai',
        'hargaObat',


    ];
}
