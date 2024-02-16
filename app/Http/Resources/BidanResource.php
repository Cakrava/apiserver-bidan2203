<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BidanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idBidan' => $this->idBidan,
            'SIPB' => $this->SIPB,
            'namaBidan' => $this->namaBidan,
            'jenisKelamin' => $this->jenisKelamin,
            'tmpLahir' => $this->tmpLahir,
            'tglLahir' => $this->tglLahir,
            'alamatPraktik' => $this->alamatPraktik,
            // 'tglTerbitSIPB' => $this->tglTerbitSIPB,
            // 'tglBerlakuSIPB' => $this->tglBerlakuSIPB,
            // 'tglPerpanjangan' => $this->tglPerpanjangan,
            'nohpBidan' => $this->nohpBidan,
            'status' => $this->status,
            'catatan' => $this->catatan,
            'fotoBidan' => $this->fotoBidan,
        ];
    }
}
