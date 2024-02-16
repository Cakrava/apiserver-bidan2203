<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idObat' => $this->idObat,
            'namaObat' => $this->namaObat,
            'stok' => $this->stok,
            'caraPakai' => $this->caraPakai,
            'hargaObat' => $this->hargaObat,

        ];
    }
}
