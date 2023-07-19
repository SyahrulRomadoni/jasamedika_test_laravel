@extends('layouts.app')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container pt-4 px-4">

    {{-- Button Create --}}
    <div class="row">
        <div class="col-md-6">
            <h1>Pasien</h1>
        </div>
        <div class="col-md-6">
            <div class="text-end">
                <button type="button" class="btn btn-primary" style="width: 60px; height: 60px; border-radius: 100px;" data-bs-toggle="modal" data-bs-target="#form">
                    <i style="font-size: 40px;" class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- DataTables --}}
    <div class="row py-3">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">List Data Pasien</h6>
                <div class="table-responsive">
                    <table id="tbl_pasien" class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">No</th>
                                <th scope="col" style="width: 150px;">No. Pasien</th>
                                <th scope="col" style="width: 150px;">Nama</th>
                                <th scope="col" style="width: 150px;">Alamat</th>
                                <th scope="col">No. Telepon</th>
                                <th scope="col" style="width: 150px;">Kelurahan</th>
                                <th scope="col" style="width: 150px;">Kecamatan</th>
                                <th scope="col" style="width: 150px;">Kota</th>
                                <th scope="col">RT/RW</th>
                                <th scope="col" style="width: 150px;">Tanggal Lahir</th>
                                <th scope="col" style="width: 150px;">Jenis Kelamin</th>
                                <th scope="col" style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('layouts.page.pasien.modal')

</div>
@endsection

{{-- JS --}}
@include('layouts.page.pasien.js')