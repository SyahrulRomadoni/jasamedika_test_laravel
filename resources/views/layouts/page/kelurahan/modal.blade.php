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
                        <label class="col-sm-2">Kelurahan</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Kecamatan</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Kota</label>
                        <div class="col-sm-10 input-data">
                            <input type="text" class="form-control" name="kota" id="kota" placeholder="xxxxxxxxxx">
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