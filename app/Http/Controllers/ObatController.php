<?php

namespace App\Http\Controllers;

use App\Http\Resources\ObatResource;
use App\Models\tbObat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = tbObat::query();
        if (request()->has("search")) {
            $search = $request->get("search");
            $query->where("idObat", "like", "%" . $search . "%")
                ->orWhere("namaObat", "like", "%" . $search . "%");
        }
        $obat = $query->paginate(10);




        return ObatResource::collection($obat);
    }

    /**
     * Store a newly created resource in storage.
     */

    //CODING TAMBAH
    public function store(Request $request)
    {
        $data = $request->validate([

            'idObat' => 'required|unique:tbobat,idObat|min:7|max:7',
            'namaObat' => 'required|max:100',
            'stok' => 'required|max:100',
            'caraPakai' => 'required|max:100',
            'hargaObat' => 'required|max:100',


        ], [
            'idObat.required' => ':attribute tidak boleh kosong',
            'idObat.unique' => ':attribute sudah ada',
            'idObat.min' => 'Minimal 7 karakter',
            'idObat.max' => 'Maksimal 7 karakter',
            'namaObat.required' => ':attribute tidak boleh kosong',
            'stok.required' => ':attribute tidak boleh kosong',
            'caraPakai.required' => ':attribute tidak boleh kosong',
            'hargaObat.required' => ':attribute tidak boleh kosong',


        ], [
            'idObat' => 'ID Obat',
            'namaObat' => 'Nama Obat',
            'stok' => 'Stok Obat',
            'caraPakai' => 'Cara Pakai Obat',
            'hargaObat' => 'Harga Obat',



        ]);
        $obat = tbObat::create($data);
        return new ObatResource($obat);

    }

    /**
     * Display the specified resource.
     */
    //CODING NAMPILKAN DATA
    public function show(string $idObat)
    {
        $obat = tbObat::find($idObat);
        if (!$obat) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);

        } else {
            return response()->json($obat);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //CODING EDIT
    public function update(Request $request, string $idObat)
    {
        //cari maahasiswa berdasarkan nim
        $obat = tbObat::find($idObat);
        if (!$obat) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        //validasi request
        $data = $request->validate(
            [
                'namaObat' => 'required|max:100',
                'stok' => 'required|max:100',
                'caraPakai' => 'required|max:100',
                'hargaObat' => 'required|max:100',

            ]
        );
        //update data mahasiswa
        $obat->update($data);
        //mengembalikan response
        return response()->json($obat, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //CODING HAPUS
    public function destroy(string $idObat)
    {
        $obat = tbObat::find($idObat);
        if (!$obat) {
            return response()->json(['message' => 'Data not found '], 404);

        }
        $obat->delete();
        return response()->json(['message' => 'Data deleted sucessfuly'], 200);
    }

    //CODING UPLOAD

}
