<?php
namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == "admin") {
            if ($request->ajax()) {
                $data = Kelurahan::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('layouts.page.kelurahan.index');
        } else {
            abort(403);
        }
    }

    public function create(Request $request)
    {
        if (Auth::user()->role == "admin") {
            $model = new Kelurahan;
            $model->kelurahan = $request->kelurahan;
            $model->kecamatan = $request->kecamatan;
            $model->kota = $request->kota;
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
        } else {
            abort(403);
        } 
    }

    public function edit(Request $request)
    {
        if (Auth::user()->role == "admin") {
            $model = Kelurahan::where('id', $request->id)->first();

            if ($model) {
                return Response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data berhasil ditemukan',
                    'data' => $model
                ]);
            } else {
                return Response()->json([
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Data gagal ditemukan',
                    'data' => ""
                ]);
            }
        } else {
            abort(403);
        } 
    }

    public function update(Request $request)
    {
        if (Auth::user()->role == "admin") {
            $model = Kelurahan::where('id', $request->id)->first();
            $model->kelurahan = $request->kelurahan;
            $model->kecamatan = $request->kecamatan;
            $model->kota = $request->kota;
            $model->save();

            if ($model) {
                return Response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return Response()->json([
                    'code' => 431,
                    'status' => 'error',
                    'message' => 'Data gagal diupdate'
                ]);
            }
        } else {
            abort(403);
        }
    }

    // public function delete(Request $request)
    // {
    //     if (Auth::user()->role == "admin") {
    //         $model = Kelurahan::where('id', $request->id)->first();
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
}
