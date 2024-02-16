<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbBidan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "tbbidan";
    protected $keyType = 'string';
    protected $primaryKey = "idBidan";

    protected $fillable = [
        'idBidan',
        'SIPB',
        'namaBidan',
        'jenisKelamin',
        'tmpLahir',
        'tglLahir',
        'alamatPraktik',
        // 'tglTerbitSIPB',
        // 'tglBerlakuSIPB',
        // 'tglPerpanjangan',
        'nohpBidan',
        'status',
        'catatan',
        'fotoBidan',
        'foto_thumb',
    ];
}
