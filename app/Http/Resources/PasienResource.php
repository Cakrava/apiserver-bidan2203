<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'noRekamMedis' => $this->noRekamMedis,
            'nikPasien' => $this->nikPasien,
            'namaPasien' => $this->namaPasien,
            'jenisKelamin' => $this->jenisKelamin,
            'tmpLahirPasien' => $this->tmpLahirPasien,
            'tglLahirPasien' => $this->tglLahirPasien,
            'alamatPasien' => $this->alamatPasien,
            'nohpPasien' => $this->nohpPasien,
            'tglPendaftaran' => $this->tglPendaftaran,
            'catatan' => $this->catatan,
            'fotoPasien' => $this->fotoPasien,
        ];
    }
}
