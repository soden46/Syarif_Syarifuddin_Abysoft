<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Peserta;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Controller Tabel Data Penduduk
    public function index(Request $request)
    {

        $datapeserta = DB::table('antrian')
            ->select('peserta.*', 'antrian.peserta', 'antrian.status')
            ->join('peserta', 'peserta.id', '=', 'antrian.peserta')
            ->get();
        $antrian = DB::table('antrian')
            ->select('peserta.*', 'antrian.peserta', 'antrian.status')
            ->join('peserta', 'peserta.id', '=', 'antrian.peserta')
            ->where('antrian.status', '=', 'Menunggu Antrian')
            ->paginate(1);
        $provinsi = Provinsi::get();
        $kabupaten = kabupaten::get();
        return view('contents.index', compact('datapeserta', 'antrian', 'request', 'provinsi', 'kabupaten'));
    }

    // Controller Form Registrasi
    public function create()
    {

        $provinsi = provinsi::get();
        $kabupaten = kabupaten::get();
        $kecamatan = Kecamatan::get();
        $kelurahan = Kelurahan::get();

        return view(
            'contents.create',
            compact('provinsi', 'kabupaten', 'kecamatan', 'kelurahan')
        );
    }

    // Controller Tambah Data Ke Database
    public function store(Request $request)
    {

        // Ambil Nama Provinsi Berdasarkan Kode Provinsi
        $prov = Provinsi::where('code', $request->provinsi)->get()->value('name');
        // Ambil Nama Kabupaten Berdasarkan Kode Provinsi
        $kab = Kabupaten::where('code', $request->kabupaten)->get()->value('name');
        // Ambil Nama Kecamatan Berdasarkan Kode Kabupaten
        $kec = Kecamatan::where('code', $request->kecamatan)->get()->value('name');
        // Validasi Data
        $request->validate([
            'nama' => 'required',
            'nomor_ktp' => 'required|max:18',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'gol_darah' => 'required'
        ]);
        // Simpan Data Ke Database
        $create =  Peserta::create([
            'nama' => $request->nama,
            'nomor_ktp' => $request->nomor_ktp,
            'alamat' => $request->alamat,
            'kecamatan' => $kec,
            'kabupaten' => $kab,
            'provinsi' => $prov,
            'pekerjaan' => $request->pekerjaan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'gol_darah' => $request->gol_darah
        ]);

        // Ambil Id Peserta Vaksin Yang Baru Dibuat 
        $idPeserta = $create->id;
        // Membuat No Antrian
        $no_antrian = $idPeserta;
        // Menambahkan No Antrian
        $antrian = Peserta::where('id', $idPeserta)->update(['nomor_antrian' => '0' . $no_antrian]);
        // Insert Data Ke Tabel Antrian
        Antrian::create([
            'peserta' => $idPeserta,
            'status' => 'Menunggu Antrian'
        ]);
        // Mengalihkan Ke Halaman Nomor Antrian
        return view('contents.antrian', compact('create', 'no_antrian'))->with('success', 'Data Penduduk Berhasil Ditambahkan');
    }

    public function konfirmasi($id)
    {
        $antrian = Antrian::where([
            'peserta' => $id,
        ])->update(['status' => 'Diperiksa']);

        return back();
    }

    // public function getNomorAntrianDipanggil(Request $request)
    public function next(Request $request)
    {
        $antrianId  = $request["nomor_antrian"];
        $antrian    = Peserta::where('nomor_antrian', $antrianId)->get()
            ->first();

        return response()->json([
            'kode'      => $antrian->nomor_antrian,
        ]);
    }

    // Controller Halaman Antrian
    public function antrian($id)
    {
        $antrian = Peserta::where('nomor_antrian', $id)
            ->get()->first();
        $data = [
            'antrian' =>  $antrian
        ];
        $pdf = Pdf::loadView('contents.pdfantrian', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Antrian-0" . $antrian->id . ".pdf";
        return $pdf->download($name);
    }
}
