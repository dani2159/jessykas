@extends('admin.layout.index', ['title' => 'Laporan Penerimaan KAS'])


@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Penerimaan KAS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Laporan Penerimaan KAS</li>
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
                                <h3 class="card-title">Laporan Penerimaan KAS</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="javascript:void(0)" id="formUpdate" method="POST">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Dari Tanggal</label>
                                                <input type="date" class="form-control" name="from_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Sampai Tanggal</label>
                                                <input type="date" class="form-control" name="to_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <label>&nbsp;</label>
                                            <div class="form-group">

                                                <button type="submit" class="btn btn-primary"><span
                                                        class="fa fa-filter"></span> Filter Data</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <table id="tabledata" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Income</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                var from = $('input[name="from_date"]').val();
                var to = $('input[name="to_date"]').val();
                table.columns(1).search(from).draw();
                table.columns(2).search(to).draw();
            });

            // DataTable
            var table = $('#tabledata').DataTable({
                searching: false,
                responsive: true,
                processing: true,
                serverSide: true,
                dom: 'lBfrtip ',
                buttons: [{
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]

                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        text: '<i class="fas fa-print"></i> Print',
                        layout: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        }
                    },
                ],
                ajax: {
                    url: "{{ route('laporan.penerimaan.list') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: function(d) {
                        d.from_date = $('input[name="from_date"]').val();
                        d.to_date = $('input[name="to_date"]').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'no_income',
                        name: 'no_income'
                    },
                    {
                        data: 'tanggal_penerimaan',
                        name: 'tanggal_penerimaan'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'jumlah_penerimaan',
                        name: 'jumlah_penerimaan'
                    }
                ],
                language: {
                    processing: "Sedang memproses...",
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Data kosong",
                },
            });
        });
    </script>
@endsection
