<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use TCPDF;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        // if (Auth::user()->role == "operator") {
            $kelurahan = Kelurahan::all();
            if ($request->ajax()) {
                $data = Pasien::with('kelurahan')->latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('layouts.page.pasien.index', compact('kelurahan'));
        // } else {
        //     abort(403);
        // }
    }

    public function create(Request $request)
    {
        // if (Auth::user()->role == "operator") {
            $model = new Pasien;

            // Mendapatkan tahun dan bulan saat ini
            $currentYear = date('y');
            $currentMonth = date('m');

            // Mendapatkan nomor pasien terakhir dari database, jika ada
            $lastPatient = Pasien::orderBy('no_pasien', 'desc')->first();
            $lastPatientNumber = 0;

            if ($lastPatient) {
                $lastPatientNumber = substr($lastPatient->no_pasien, -6); // Mengambil 6 digit terakhir dari nomor pasien terakhir
            }

            // Menghitung nomor pasien berikutnya
            $nextPatientNumber = str_pad($lastPatientNumber + 1, 6, '0', STR_PAD_LEFT);

            // Menggabungkan tahun, bulan, dan nomor urut untuk membentuk nomor pasien baru
            $newPatientNumber = $currentYear . $currentMonth . $nextPatientNumber;
            
            $model->no_pasien = $newPatientNumber;
            $model->nama = $request->nama;
            $model->alamat = $request->alamat;
            $model->no_telepon = $request->no_telepon;
            $model->id_kelurahan = $request->id_kelurahan;
            $model->rt_rw = $request->rt_rw;
            $model->tanggal_lahir = $request->tanggal_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->save();

            if ($model) {
                return Response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan'
                ]);
            } else {
                return Response()->json([
                    'code' => 431,
                    'status' => 'error',
                    'message' => 'Data gagal disimpan'
                ]);
            }
        // } else {
        //     abort(403);
        // }
    }

    // public function edit(Request $request)
    // {
    //     if (Auth::user()->role == "operator") {
    //         $model = Pasien::where('id', $request->id)->first();

    //         if ($model) {
    //             return Response()->json([
    //                 'code' => 200,
    //                 'status' => 'success',
    //                 'message' => 'Data berhasil ditemukan',
    //                 'data' => $model
    //             ]);
    //         } else {
    //             return Response()->json([
    //                 'code' => 404,
    //                 'status' => 'error',
    //                 'message' => 'Data gagal ditemukan',
    //                 'data' => ""
    //             ]);
    //         }
    //     } else {
    //         abort(403);
    //     }
    // }

    // public function update(Request $request)
    // {
    //     if (Auth::user()->role == "operator") {
    //         $model = Pasien::where('id', $request->id)->first();
    //         $model->nama = $request->nama;
    //         $model->alamat = $request->alamat;
    //         $model->no_telepon = $request->no_telepon;
    //         $model->id_kelurahan = $request->id_kelurahan;
    //         $model->rt_rw = $request->rt_rw;
    //         $model->tanggal_lahir = $request->tanggal_lahir;
    //         $model->jenis_kelamin = $request->jenis_kelamin;
    //         $model->save();

    //         if ($model) {
    //             return Response()->json([
    //                 'code' => 200,
    //                 'status' => 'success',
    //                 'message' => 'Data berhasil diupdate'
    //             ]);
    //         } else {
    //             return Response()->json([
    //                 'code' => 431,
    //                 'status' => 'error',
    //                 'message' => 'Data gagal diupdate'
    //             ]);
    //         }
    //     } else {
    //         abort(403);
    //     }
    // }

    // public function delete(Request $request)
    // {
    //     if (Auth::user()->role == "operator") {
    //         $model = Pasien::where('id', $request->id)->first();
    //         $model->delete();

    //         if ($model) {
    //             return Response()->json([
    //                 'code' => 200,
    //                 'status' => 'success',
    //                 'message' => 'Data berhasil dihapus'
    //             ]);
    //         } else {
    //             return Response()->json([
    //                 'code' => 431,
    //                 'status' => 'error',
    //                 'message' => 'Data gagal dihapus'
    //             ]);
    //         }
    //     } else {
    //         abort(403);
    //     }
    // }

    public function cetak(Request $request)
    {
        $model = Pasien::where('no_pasien', $request->no_pasien)->first();
        $data = [
            'no_pasien' => $model->nama,
            'nama' => $model->nama,
            'alamat' => $model->alamat,
            'no_telepon' => $model->no_telepon,
        ];

        $pdf = new TCPDF();

        $pdf->SetCreator('Syahrul Romadoni');
        $pdf->SetAuthor('Syahrul Romadoni');
        $pdf->SetTitle('Kartu Pasien');

        $pdf->AddPage();
        $pdf->writeHTML(view('layouts.page.pasien.kartu', $data)->render(), true, false, true, false, '');

        $pdf->Output('kartu.pdf', 'I');
    }
}
