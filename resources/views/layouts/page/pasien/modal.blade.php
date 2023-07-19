{{-- Form Data --}}
<div class="modal fade" id="form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h3 class="modal-title" id="formLabel">Form Data</h3>
                <button id="btnClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" name="formData" id="formData" method="post" enctype="multipart/form-data">
            @csrf

                <input hidden type="text" name="id" id="id">

                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Nama</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Alamat</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">No. Telepon</label>
                        <div class="col-sm-10 input-data">
                            <input type="number" class="form-control" name="no_telepon" id="no_telepon" placeholder="xxxxxxxxxx" minlength="11" maxlength="12">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Kelurahan</label>
                        <div class="col-sm-10 input-data">
                            <select class="form-control" name="id_kelurahan" id="id_kelurahan">
                                <option selected="true" disabled="true">xxxxxxxxxx</option>
                                @foreach($kelurahan as $kl)
                                <option value="{{ $kl->id }}">{{ $kl->kelurahan }} - {{ $kl->kecamatan }} - {{ $kl->kota }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">RT/RW</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="rt_rw" id="rt_rw" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Tanggal Lahir</label>
                        <div class="col-sm-10 input-data">
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-10 input-data">
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected="true" disabled="true">xxxxxxxxxx</option>
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-simpan">Save</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal Konfirmasi Deleted --}}
<div class="modal fade" id="konfirmasiDeleted" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="konfirmasiDeletedLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h3 class="modal-title" id="konfirmasiDeletedLabel">Konfirmasi Deleted!</h3>
                <button id="btnClose1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <input hidden id="deleted_id" type="text" name="id" value="">

            <div class="modal-body">
                <div class="form-group row mb-3">
                    <p class="text-center">Apa anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-simpan" data-bs-dismiss="modal"
                    aria-label="Close">Tidak</button>
                    <button type="submit" class="btn btn-danger" id="btn-simpan" onclick="deleteData()">Ya</button>
                </div>
            </div>

        </div>
    </div>
</div>