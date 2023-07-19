@section('script')
<script>
    var tbl_pasien = null;

    {{-- Get Data Tables --}}
    $(function () {
        tbl_pasien = $('#tbl_pasien').DataTable({
            processing: true,
            serverSide: true,
            sScrollX: "100%",
            sScrollXInner: "110%",
            ajax: "{{ route('pasien.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_pasien',
                    name: 'no_pasien'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'no_telepon',
                    name: 'no_telepon'
                },
                {
                    render: function (data, type, row) {
                        var kelurahan = row.kelurahan ? row.kelurahan.kelurahan : '';
                        return `${kelurahan}`;
                    }
                },
                {
                    render: function (data, type, row) {
                        var kecamatan = row.kelurahan ? row.kelurahan.kecamatan : '';
                        return `${kecamatan}`;
                    }
                },
                {
                    render: function (data, type, row) {
                        var kota = row.kelurahan ? row.kelurahan.kota : '';
                        return `${kota}`;
                    }
                },
                {
                    data: 'rt_rw',
                    name: 'rt_rw'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    render: function (data, type, row) {
                        var jenis_kelamin = row.jenis_kelamin;
                        if (jenis_kelamin == 1) {
                            return "Laki-laki";
                        } else {
                            return "Perempuan";
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var id = row.id
                        var no_pasien = row.no_pasien

                        if (id == null) {
                            return '<td></td>';
                        } else {
                            return '<td>' +
                                '<ul class="list-inline m-0">' +
                                // '<li class="list-inline-item">' +
                                // `<a style="color: white;" class="btn btn-primary" title="Edit" onclick="edit('${id}')"><i class="fa fa-pen"></i></a>` +
                                // '</i>' +
                                // '<li class="list-inline-item">' +
                                // `<a style="color: white;" class="btn btn-danger" title="Delete" onclick="konfirmasiDeleted('${id}')"><i class="fa fa-trash"></i></a>` +
                                // '</i>' +
                                '<li class="list-inline-item">' +
                                '<a href="{{ url("/pasien/cetak-kartu") }}?no_pasien=' + no_pasien + '" style="color: white;" class="btn btn-primary" title="Cetak Kartu Pasien"><i class="fa fa-file"></i></a>' +
                                '</i>' +
                                '</ul>' +
                                '</td>';
                        }
                    }
                },
            ]
        });
    });

    {{-- Create and Update --}}
    $('#formData').validate({
        rules: {
            nama: { required: true },
            no_telepon: { required: true },
            rt_rw: { required: true },
            tanggal_lahir: { required: true },
            jenis_kelamin: { required: true },
        },
        messages: {
            nama: { required: "nama tidak boleh kosong" },
            no_telepon: { required: "No. Telepon tidak boleh kosong" },
            rt_rw: { required: "RT/RW tidak boleh kosong" },
            tanggal_lahir: { required: "Tanggal Lahir tidak boleh kosong" },
            jenis_kelamin: { required: "Jenis Kelamin tidak boleh kosong" },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-data').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            var formData = new FormData($("#formData")[0]);
            if (document.getElementById("id").value == "") {
                url = "{{route('pasien.create')}}";
            } else {
                url = "{{route('pasien.update')}}";
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function ()
                {
                    $("#btn-simpan").attr("disabled", true);
                    $("#btn-simpan").html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                },
                success: (data) => {
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function() {
                            tbl_pasien.ajax.reload();
                            $('#form').modal('hide');
                            $("#id").val("");
                            $("#nama").val("");
                            $("#alamat").val("");
                            $("#no_telepon").val("");
                            $('#id_kelurahan').val("").change();
                            $("#rt_rw").val("");
                            $("#tanggal_lahir").val("");
                            $("#jenis_kelamin").val("");
                        });
                    } else {
                        swal('Error', data.message, 'error');
                    }
                },
                complete: function (xhr) {
                    $("#btn-simpan").html('Save');
                    $("#btn-simpan").attr("disabled", false);
                },
                error: function (data) {
                    console.log(data);
                    if (document.getElementById("id").value == "") {
                        ("#id").val("");
                    }
                    $("#nama").val("");
                    $("#alamat").val("");
                    $("#no_telepon").val("");
                    $('#id_kelurahan').val("").change();
                    $("#rt_rw").val("");
                    $("#tanggal_lahir").val("");
                    $("#jenis_kelamin").val("");
                }
            });
        }
    });

    {{-- Edit --}}
    function edit(id) {
        var id = id;
        var url = "{{ route('pasien.edit') }}";
 
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (result) {
                $('#form').modal('show');
                $('#id').val(result.data.id);
                $("#nama").val(result.data.nama);
                $("#alamat").val(result.data.alamat);
                $("#no_telepon").val(result.data.no_telepon);
                $('#id_kelurahan').val(result.data.id_kelurahan).change();
                $("#rt_rw").val(result.data.rt_rw);
                $("#tanggal_lahir").val(result.data.tanggal_lahir);
                $("#jenis_kelamin").val(result.data.jenis_kelamin);
            }
        })
    }

    {{-- Delete --}}
    function konfirmasiDeleted(id) {
        $('#konfirmasiDeleted').modal('show');
        $('#deleted_id').val(id);
    }

    function deleteData() {
        var data_id = document.getElementById("deleted_id").value;
        if(data_id !== "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "{{ route('pasien.delete') }}",
                data: {
                    id: data_id
                },
                success: function (data) {
                    $('#konfirmasiDeleted').modal('hide');
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function() {
                            tbl_pasien.ajax.reload();
                            $('#konfirmasiDeleted').modal('hide');
                            $("#deleted_id").val("");
                        });
                    } else {
                        swal('Error', data.message, 'error');
                    }
                },
                error: function (data) {
                    $('#konfirmasiDeleted').modal('hide');
                    swal('Error', 'Terjadi Kesalahan', 'error');
                }
            });
        } else {
            swal('Error', 'Data tidak bisa di hapus', 'error');
        }
    }

    {{-- Select2 --}}
    $('#id_kelurahan').each(function () {
        $(this).select2({
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });
</script>
@endsection