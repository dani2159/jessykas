@extends('admin.layout.index', ['title' => 'Data Pengeluaran KAS'])

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pengeluaran KAS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Pengeluaran KAS</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="float-right btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addModal" data-backdrop="static" data-keyboard="false"><span
                                        class="fa fa-plus"></span> Tambah Data Pengeluaran KAS</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer"
                                    id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. Expenditure</th>
                                            <th>Kode Beban</th>
                                            <th>Nama Beban</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->no_expenditure }}</td>
                                                <td>{{ $item->kode_beban }}</td>
                                                <td>{{ $item->nama_beban }}</td>
                                                <td>{{ Tgl_Indo($item->tanggal_pengeluaran) }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>Rp. {{ number_format($item->jumlah_pengeluaran, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary btn-sm"
                                                            onclick="ubahData({{ $item }})"><span
                                                                class="fa fa-pencil-alt"></span></button>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="hapusData({{ $item->id }})"><span
                                                                class="fa fa-trash"></span></button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formInsert" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Pengeluaran KAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_expenditure"><span class="text-danger">*</span> No. expenditure</label>
                            <input type="text" class="form-control" id="no_expenditure" name="no_expenditure" required
                                readonly value="{{ $no_expenditure }}" placeholder="Masukkan No expenditure">
                        </div>
                        <div class="form-group">
                            <label for="beban"><span class="text-danger">*</span> Beban</label>
                            <select name="kode_beban" id="beban" class="form-control" required>
                                <option value="">-- Pilih Beban --</option>
                                @foreach ($beban as $item)
                                    <option value="{{ $item->kode_beban }}">{{ $item->kode_beban }} -
                                        {{ $item->nama_beban }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal"><span class="text-danger">*</span> Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                placeholder="Masukkan Tanggal pengeluaran KAS">
                        </div>
                        <div class="form-group">
                            <label for="keterangan"><span class="text-danger">*</span> Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" required placeholder="Masukkan Keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pengeluaran"><span class="text-danger">*</span> Nominal (Rp.)</label>
                            <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaran" class="form-control"
                                required placeholder="Masukkan Nominal Jumlah pengeluaran KAS" min="1">
                            <small style="color:red;font-size: 80%;font-weight: 400;">Masukkan nominal tanpa titik atau
                                koma</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span
                                class="fa fa-ban"></span>
                            Batal</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formUpdate" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Pengeluaran KAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_expenditure"><span class="text-danger">*</span> No. expenditure</label>
                            <input type="text" class="form-control" id="no_incomeu" name="no_expenditure" required
                                readonly value="{{ $no_expenditure }}" placeholder="Masukkan No. expenditure">
                        </div>
                        <div class="form-group">
                            <label for="beban"><span class="text-danger">*</span> Beban</label>
                            <select name="kode_beban" id="bebanu" class="form-control" required>
                                <option value="">-- Pilih Beban --</option>
                                @foreach ($beban as $item)
                                    <option value="{{ $item->kode_beban }}">{{ $item->kode_beban }} -
                                        {{ $item->nama_beban }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal"><span class="text-danger">*</span> Tanggal</label>
                            <input type="date" class="form-control" id="tanggalu" name="tanggal" required
                                placeholder="Masukkan Tanggal pengeluaran KAS">
                        </div>
                        <div class="form-group">
                            <label for="keterangan"><span class="text-danger">*</span> Keterangan</label>
                            <textarea name="keterangan" id="keteranganu" class="form-control" required placeholder="Masukkan Keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pengeluaran"><span class="text-danger">*</span> Nominal (Rp.)</label>
                            <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaranu"
                                class="form-control" required placeholder="Masukkan Nominal Jumlah pengeluaran KAS"
                                min="1">
                            <small style="color:red;font-size: 80%;font-weight: 400;">Masukkan nominal tanpa titik atau
                                koma</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span
                                class="fa fa-ban"></span> Batal</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                    "targets": 3,
                    "orderable": false
                }]
            });

            $('#formInsert').on('submit', (function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('pengeluaran.insert') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data, status, xhr) {
                        $.LoadingOverlay("hide");
                        try {
                            var result = JSON.parse(xhr.responseText);
                            if (result.status) {
                                swal(result.message, {
                                    icon: "success",
                                    title: "Success",
                                    text: result.message,
                                }).then((acc) => {
                                    location.reload();
                                });
                            } else {
                                swal("Warning!", result.message, "warning");
                            }
                        } catch (e) {
                            swal("Warning!", "Terjadi kesahalan sistem", "error");
                        }
                    },
                    error: function(data) {
                        $.LoadingOverlay("hide");
                        swal("Warning!", "Terjadi kesahalan sistem", "error");
                    }
                });
            }));

            $('#formUpdate').on('submit', (function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('pengeluaran.update') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data, status, xhr) {
                        $.LoadingOverlay("hide");
                        try {
                            var result = JSON.parse(xhr.responseText);
                            if (result.status) {
                                swal(result.message, {
                                    icon: "success",
                                    title: "Success",
                                    text: result.message,
                                }).then((acc) => {
                                    location.reload();
                                });
                            } else {
                                swal("Warning!", result.message, "warning");
                            }
                        } catch (e) {
                            swal("Warning!", "Terjadi kesahalan sistem", "error");
                        }
                    },
                    error: function(data) {
                        $.LoadingOverlay("hide");
                        swal("Warning!", "Terjadi kesahalan sistem", "error");
                    }
                });
            }));
        });

        function hapusData(id) {
            swal({
                    title: "Apakah anda yakin ?",
                    text: "Ketika data telah dihapus, tidak bisa dikembalikan lagi!",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.LoadingOverlay("show");
                        $.ajax({
                            method: 'DELETE',
                            url: "{{ route('pengeluaran.delete') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                id
                            },
                            success: function(data, status, xhr) {
                                $.LoadingOverlay("hide");
                                try {
                                    var result = JSON.parse(xhr.responseText);
                                    if (result.status) {
                                        swal(result.message, {
                                            icon: "success",
                                        }).then((acc) => {
                                            location.reload();
                                        });
                                    } else {
                                        swal("Warning!", "Terjadi kesalahan sistem", "warning");
                                    }
                                } catch (e) {
                                    swal("Warning!", "Terjadi kesalahan sistem", "error");
                                }
                            },
                            error: function(data) {
                                $.LoadingOverlay("hide");
                                swal("Warning!", "Terjadi kesalahan sistem", "error");
                            }
                        });
                    }
                });
        }

        function ubahData(item) {
            $('#id').val(item.id);
            $('#no_expenditureu').val(item.no_expenditure);
            $('#bebanu').val(item.kode_beban).trigger('change');
            $('#tanggalu').val(item.tanggal_pengeluaran);
            $('#keteranganu').val(item.keterangan);
            $('#jumlah_pengeluaranu').val(item.jumlah_pengeluaran);
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection
