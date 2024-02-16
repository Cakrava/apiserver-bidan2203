<?php

namespace App\Http\Controllers;

use App\Http\Resources\PasienResource;
use App\Models\tbPasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = tbPasien::query();
        if (request()->has("search")) {
            $search = $request->get("search");
            $query->where("noRekamMedis", "like", "%" . $search . "%")
                ->orWhere("nikPasien", "like", "%" . $search . "%");
        }
        $pasien = $query->paginate(10);




        return PasienResource::collection($pasien);
    }

    /**
     * Store a newly created resource in storage.
     */

    //CODING TAMBAH
    public function store(Request $request)
    {
        $data = $request->validate([

            'noRekamMedis' => 'required|unique:tbpasien,noRekamMedis|min:7|max:7',
            'nikPasien' => 'required|max:100',
            'namaPasien' => 'required|max:100',
            'jenisKelamin' => 'required|in:L,P',
            'tmpLahirPasien' => 'required|max:100',
            'tglLahirPasien' => 'required|date',
            'alamatPasien' => 'required',
            'nohpPasien' => 'required|max:20',
            'tglPendaftaran' => 'required|date',
            'catatan' => 'required|max:100',
            'fotoPasien' => 'max:200',
        ], [
            'noRekamMedis.required' => ':attribute tidak boleh kosong',
            'noRekamMedis.unique' => ':attribute sudah ada',
            'noRekamMedis.min' => 'Minimal 7 karakter',
            'noRekamMedis.max' => 'Maksimal 7 karakter',
            'nikPasien.required' => ':attribute tidak boleh kosong',
            'namaPasien.required' => ':attribute tidak boleh kosong',
            'jenisKelamin.required' => ':attribute tidak boleh kosong',
            'tmpLahirPasien.required' => ':attribute tidak boleh kosong',
            'tglLahirPasien.required' => ':attribute tidak boleh kosong',
            'alamatPasien.required' => ':attribute tidak boleh kosong',
            'nohpPasien.required' => ':attribute tidak boleh kosong',
            'tglPendaftaran.required' => ':attribute tidak boleh kosong',
            'catatan.required' => ':attribute tidak boleh kosong',

        ], [
            'noRekamMedis' => 'No Rekam Medis',
            'nikPasien' => 'NIK Pasien',
            'namaPasien' => 'Nama Lengkap Pasien',
            'jenisKelamin' => 'Jenis Kelamin Pasien',
            'tmpLahirPasien' => 'Tempat Lahir Pasien',
            'tglLahirPasien' => 'Tanggal Lahir Pasien',
            'alamatPasien' => 'Alamat Pasien',
            'nohpPasien' => 'No.Telp Pasien',
            'tglPendaftaran' => 'Tanggal Pendaftaran',
            'catatan' => 'catatan',


        ]);
        $pasien = tbPasien::create($data);
        return new PasienResource($pasien);

    }

    /**
     * Display the specified resource.
     */
    //CODING NAMPILKAN DATA
    public function show(string $noRekamMedis)
    {
        $pasien = tbPasien::find($noRekamMedis);
        if (!$pasien) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);

        } else {
            return response()->json($pasien);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //CODING EDIT
    public function update(Request $request, string $noRekamMedis)
    {
        //cari maahasiswa berdasarkan nim
        $pasien = tbPasien::find($noRekamMedis);
        if (!$pasien) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        //validasi request
        $data = $request->validate(
            [
                'nikPasien' => 'required|max:100',
                'namaPasien' => 'required|max:100',
                'jenisKelamin' => 'required|in:L,P',
                'tmpLahirPasien' => 'required|max:100',
                'tglLahirPasien' => 'required|date',
                'alamatPasien' => 'required',
                'nohpPasien' => 'required|max:20',
                'tglPendaftaran' => 'required|date',
                'catatan' => 'required|max:100',
            ]
        );
        //update data mahasiswa
        $pasien->update($data);
        //mengembalikan response
        return response()->json($pasien, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //CODING HAPUS
    public function destroy(string $noRekamMedis)
    {
        $pasien = tbPasien::find($noRekamMedis);
        if (!$pasien) {
            return response()->json(['message' => 'Data not found '], 404);

        }
        $pasien->delete();
        return response()->json(['message' => 'Data deleted sucessfuly'], 200);
    }

    //CODING UPLOAD
    public function uploadImage(Request $request, string $sipb)
    {
        $pasien = tbPasien::find($sipb);
        if (!$pasien) {
            return response()->json(['message' => 'Data not found '], 404);

        }
        $validateData = $request->validate(
            [
                'fotoPasien' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]


        );
        if ($request->hasFile('foto')) {
            //hapus gambar lama
            if ($pasien->fotoPasien && file_exists(public_path($pasien->fotoPasien))) {
                unlink(public_path($pasien->fotoPasien));
                unlink(public_path($pasien->foto_thumb));
            }
            //PROSES UPLOAD GAMBAR BARU
            $file = $request->file('fotoPasien');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            //kompres ukuran gambar
            $filePath = public_path('images') . '/' . $fileName;
            $fileName_Thumb = 'thumb-' . $fileName;
            $thumbPath = public_path('images/thumb/' . $fileName_Thumb);

            //cek ekstensi dan gunakan fungsi yang tepat
            switch ($file->getClientOriginalExtension()) {
                case 'jpeg':
                    $resource = imagecreatefromjpeg($filePath);
                    break;
                case 'jpg':
                    $resource = imagecreatefromjpeg($filePath);
                    break;
                case 'png':
                    $resource = imagecreatefrompng($filePath);
                    break;
                default:
                    return response()->json(['message' => 'Unsupported image type'], 400);

            }

            //cek jika resource bverhasil dibuat
            if (!$resource) {
                return response()->json(['message' => 'Error processing image'], 500);

            }

            //menyimpan gambar yang telah di resize
            imagejpeg($resource, $thumbPath, 10);
            imagedestroy($resource);  //jangan lupa melepaskan memory

            $pasien->fotoPasien = '/images/' . $fileName;
            $pasien->foto_thumb = '/images/thumb/' . $fileName_Thumb;

            $pasien->save();
            return response()->json(['message' => ' image uploaded sucessfully ', 'data' => $pasien], 200);





        }
        return response()->json(['message' => 'No image uploaded'], 400);
    }
}
