@extends('layouts.base_admin')
@section('title', 'Laporan')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="javascript:void(0)" id="formUpdate" method="POST">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Dari Tanggal</label>
                                            <input type="month" class="form-control" name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Sampai Tanggal</label>
                                            <input type="month" class="form-control" name="to_date">
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
                                        <th>Bulan</th>
                                        <th>Permohonan</th>
                                        <th>Penegakan</th>
                                        <th>Bantuan</th>
                                        <th>Pertimbangan</th>
                                        <th>Tindakan</th>
                                        <th>Pelayanan</th>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </section>
    <!-- /.content -->

@endsection

@section('js')
    <script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]

                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        text: '<i class="fas fa-print"></i> Print',
                        layout: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        }
                    },
                ],
                ajax: {
                    url: "{{ route('laporan-penerimaan.list') }}",
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
                        data: 'month',
                        name: 'month'
                    },
                    {
                        data: 'permohonan',
                        name: 'permohonan'
                    },
                    {
                        data: 'penegakan',
                        name: 'penegakan'
                    },
                    {
                        data: 'bantuan',
                        name: 'bantuan'
                    },
                    {
                        data: 'pertimbangan',
                        name: 'pertimbangan'
                    },
                    {
                        data: 'tindakan',
                        name: 'tindakan'
                    },
                    {
                        data: 'pelayanan',
                        name: 'pelayanan'
                    }
                ],
                language: {
                    processing: "Sedang memproses...",
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Data kosong",
                },
            });
            setInterval(() => {
                table.ajax.reload();
            }, 90000);
        });
    </script>

@endsection
