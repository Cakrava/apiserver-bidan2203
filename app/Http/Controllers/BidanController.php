<?php

namespace App\Http\Controllers;

use App\Http\Resources\BidanResource;
use App\Models\tbBidan;

use Illuminate\Http\Request;

class BidanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = tbBidan::query();
        if (request()->has("search")) {
            $search = $request->get("search");
            $query->where("idBidan", "like", "%" . $search . "%")
                ->orWhere("SIPB", "like", "%" . $search . "%");
        }
        $bidan = $query->paginate(10);




        return BidanResource::collection($bidan);
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    //CODING NAMPILKAN DATA
    public function show(string $idBidan)
    {
        $bidan = tbBidan::find($idBidan);
        if (!$bidan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);

        } else {
            return response()->json($bidan);
        }
    }

    //Coding store modif
    public function store(Request $request)
    {
        //kurleb sama persis bagian atas,,bedanya ada ditambahin field fotoBidan, mungkin sebelumya ada tp ga di apa
        $data = $request->validate([
            'idBidan' => 'required|unique:tbbidan,idBidan|min:7|max:7',
            'SIPB' => 'required|max:100',
            'namaBidan' => 'required|max:100',
            'jenisKelamin' => 'required|in:L,P',
            'tmpLahir' => 'required|max:100',
            'tglLahir' => 'required|date',
            'alamatPraktik' => 'required',
            'nohpBidan' => 'required|max:20',
            'status' => 'required|max:100',
            'catatan' => 'required|max:100',
            'fotoBidan' => 'image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'idBidan.required' => ':attribute tidak boleh kosong',
            'idBidan.unique' => ':attribute sudah ada',
            'idBidan.min' => 'Minimal 7 karakter',
            'idBidan.max' => 'Maksimal 7 karakter',
            'SIPB.required' => ':attribute tidak boleh kosong',
            'namaBidan.required' => ':attribute tidak boleh kosong',
            'jenisKelamin.required' => ':attribute tidak boleh kosong',
            'tmpLahir.required' => ':attribute tidak boleh kosong',
            'tglLahir.required' => ':attribute tidak boleh kosong',
            'alamatPraktik.required' => ':attribute tidak boleh kosong',
            'nohpBidan.required' => ':attribute tidak boleh kosong',
            'status.required' => ':attribute tidak boleh kosong',
            'catatan.required' => ':attribute tidak boleh kosong',
        ], [
            'idBidan' => 'ID Bidan',
            'SIPB' => 'Surat Izin Praktik Bidan',
            'namaBidan' => 'Nama Lengkap',
            'jenisKelamin' => 'Jenis Kelamin',
            'tmpLahir' => 'Tempat Lahir',
            'tglLahir' => 'Tanggal Lahir',
            'alamatPraktik' => 'Alamat',
            'nohpBidan' => 'No.Telp',
            'status' => 'Status',
            'catatan' => 'catatan',
        ]);

        // Membuat data bidan
        $bidan = tbBidan::create($data);
        //diatas sama kek td, yg lulus masuk db,,bedanya dibawah,,ada validasi lain,,

        // Proses Upload Gambar
        if ($request->hasFile('fotoBidan')) {
            $file = $request->file('fotoBidan');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            // Proses kompresi dan resize gambar
            $filePath = public_path('images') . '/' . $fileName;
            $fileName_Thumb = 'thumb-' . $fileName;
            $thumbPath = public_path('images/thumb/' . $fileName_Thumb);

            // Cek ekstensi dan gunakan fungsi yang tepat, extensi maskudnya jpg jepeg ato png gt
            switch ($file->getClientOriginalExtension()) {
                case 'jpeg':
                case 'jpg':
                    $resource = imagecreatefromjpeg($filePath);
                    break;
                case 'png':
                    $resource = imagecreatefrompng($filePath);
                    break;
                default:
                    // Tangani kasus ekstensi file yang tidak didukung
                    break;
            }

            if ($resource) {
                // Menyimpan gambar yang telah di resize
                imagejpeg($resource, $thumbPath, 10);
                imagedestroy($resource);  // Jangan lupa melepaskan memory

                // Menyimpan path gambar ke database
                $bidan->fotoBidan = '/images/' . $fileName;
                $bidan->foto_thumb = '/images/thumb/' . $fileName_Thumb;
                $bidan->save();
            }
        }
        //dibawah ini, kek td juga, kebalikan ke json di resource nya,,yg lama validasi gambar gada, cukup masuk data oke udah, kalo ni masuk gambar juga ,,tau kan bedanya,,yg lama proses upload ga ada,,intinya itu aja
        return new BidanResource($bidan);
    }

    //CODING EDIT
    public function update(Request $request, string $idBidan)
    {
        //cari maahasiswa berdasarkan nim
        $bidan = tbBidan::find($idBidan);
        if (!$bidan) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        //validasi request
        $data = $request->validate(
            [
                'SIPB' => 'required|max:100',
                'namaBidan' => 'required|max:100',
                'jenisKelamin' => 'required|in:L,P',
                'tmpLahir' => 'required|max:100',
                'tglLahir' => 'required|date',
                'alamatPraktik' => 'required',
                // 'tglTerbitSIPB' => 'required|date',
                // 'tglBerlakuSIPB' => 'required|date',
                // 'tglPerpanjangan' => 'required|date',
                'nohpBidan' => 'required|max:20',
                'status' => 'required|max:100',
                'catatan' => 'required|max:100',
            ]
        );
        //update data mahasiswa
        $bidan->update($data);
        //mengembalikan response
        return response()->json($bidan, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //CODING HAPUS
    public function destroy(string $idBidan)
    {
        $bidan = tbBidan::find($idBidan);
        if (!$bidan) {
            return response()->json(['message' => 'Data not found '], 404);

        }
        $bidan->delete();
        return response()->json(['message' => 'Data deleted sucessfuly'], 200);
    }

    //CODING UPLOAD
    public function uploadImage(Request $request, string $sipb)
    {
        $bidan = tbBidan::find($sipb);
        if (!$bidan) {
            return response()->json(['message' => 'Data not found '], 404);

        }
        $validateData = $request->validate(
            [
                'fotoBidan' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]


        );
        if ($request->hasFile('foto')) {
            //hapus gambar lama
            if ($bidan->fotoBidan && file_exists(public_path($bidan->fotoBidan))) {
                unlink(public_path($bidan->fotoBidan));
                unlink(public_path($bidan->foto_thumb));
            }
            //PROSES UPLOAD GAMBAR BARU
            $file = $request->file('fotoBidan');
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

            $bidan->fotoBidan = '/images/' . $fileName;
            $bidan->foto_thumb = '/images/thumb/' . $fileName_Thumb;

            $bidan->save();
            return response()->json(['message' => ' image uploaded sucessfully ', 'data' => $bidan], 200);





        }
        return response()->json(['message' => 'No image uploaded'], 400);
    }



}
