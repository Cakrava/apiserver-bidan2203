<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbPasien extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "tbpasien";
    protected $keyType = 'string';
    protected $primaryKey = "noRekamMedis";

    protected $fillable = [
        'noRekamMedis',
        'nikPasien',
        'namaPasien',
        'jenisKelamin',
        'tmpLahirPasien',
        'tglLahirPasien',
        'alamatPasien',
        'nohpPasien',
        'tglPendaftaran',
        'catatan',
        'fotoPasien',
        'foto_thumb',

    ];
}
