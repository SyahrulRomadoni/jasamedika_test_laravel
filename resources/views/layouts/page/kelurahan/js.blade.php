@section('script')
<script>
    var tbl_kelurahan = null;

    {{-- Get Data Tables --}}
    $(function () {
        tbl_kelurahan = $('#tbl_kelurahan').DataTable({
            processing: true,
            serverSide: true,
            sScrollX: "100%",
            sScrollXInner: "110%",
            ajax: "{{ route('kelurahan.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kelurahan',
                    name: 'kelurahan'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
                },
                {
                    data: 'kota',
                    name: 'kota'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var id = row.id

                        if (id == null) {
                            return '<td></td>';
                        } else {
                            return '<td>' +
                                '<ul class="list-inline m-0">' +
                                '<li class="list-inline-item">' +
                                `<a style="color: white;" class="btn btn-primary" title="Edit" onclick="edit('${id}')"><i class="fa fa-pen"></i></a>` +
                                '</i>' +
                                // '<li class="list-inline-item">' +
                                // `<a style="color: white;" class="btn btn-danger" title="Delete" onclick="konfirmasiDeleted('${id}')"><i class="fa fa-trash"></i></a>` +
                                // '</i>' +
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
            kelurahan: { required: true },
            kecamatan: { required: true },
            kota: { required: true },
        },
        messages: {
            kelurahan: { required: "Kelurahan tidak boleh kosong"  },
            kecamatan: { required: "Kecamatan tidak boleh kosong"  },
            kota: { required: "Kota tidak boleh kosong"  },
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
                url = "{{route('kelurahan.create')}}";
            } else {
                url = "{{route('kelurahan.update')}}";
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
                            tbl_kelurahan.ajax.reload();
                            $('#form').modal('hide');
                            $("#id").val("");
                            $("#kelurahan").val("");
                            $("#kecamatan").val("");
                            $("#kota").val("");
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
                    $("#kelurahan").val("");
                    $("#kecamatan").val("");
                    $("#kota").val("");
                }
            });
        }
    });

    {{-- Edit --}}
    function edit(id) {
        var id = id;
        var url = "{{ route('kelurahan.edit') }}";
 
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (result) {
                $('#form').modal('show');
                $('#id').val(result.data.id);
                $('#kelurahan').val(result.data.kelurahan);
                $('#kecamatan').val(result.data.kecamatan);
                $('#kota').val(result.data.kota);
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
                url: "{{ route('kelurahan.delete') }}",
                data: {
                    id: data_id
                },
                success: function (data) {
                    $('#konfirmasiDeleted').modal('hide');
                    if (data.status == 'success') {
                        swal("Success", data.message, "success").then(function() {
                            tbl_kelurahan.ajax.reload();
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
</script>
@endsection