@extends('admin.layout.index', ['title' => 'Laporan KAS'])

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        @media print {
            h1 {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan KAS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Laporan KAS</li>
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
                                <h3 class="card-title">Laporan KAS</h3>
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
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Filter</label>
                                                <select class="form-control" name="filter_data">
                                                    <option value="all">Semua</option>
                                                    <option value="penerimaan">Penerimaan</option>
                                                    <option value="pengeluaran">Pengeluaran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 ">
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
                                            <th>No. Rekap</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th class="text-right">Debit</th>
                                            <th class="text-right">Kredit</th>
                                            <th class="text-right">Saldo</th>
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
    <script src="{{ asset('assets/js/day/day.js') }}"></script>
    <script src="{{ asset('assets/js/day/id.js') }}"></script>
    <script>
        $(function() {
            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                var from = $('input[name="from_date"]').val();
                var to = $('input[name="to_date"]').val();
                var filter_data = $('select[name="filter_data"]').val();

                table.columns(1).search(from).draw();
                table.columns(2).search(to).draw();
                table.columns(3).search(filter_data).draw();
            });

            // DataTable
            var table = $('#tabledata').DataTable({
                searching: false,
                responsive: true,
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                            title: '',
                            format: {
                                header: function(data, columnIdx) {
                                    return 'Kop Surat Anda';
                                },
                                footer: function(data, columnIdx) {
                                    return 'Dicetak pada tanggal ' + moment().format('DD-MM-YYYY') +
                                        ' | Saldo Akhir: ' + $('#endingBalance').text();
                                }
                            }
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr('s', '42');
                        }
                    },
                    // {
                    //     extend: 'pdf',
                    //     className: 'btn btn-danger',
                    //     text: '<i class="fas fa-file-pdf"></i> PDF',
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4, 5, 6],
                    //     },
                    //     customize: function(doc) {
                    //         doc.content.splice(0, 0, {
                    //             margin: [0, 0, 0, 10],
                    //             alignment: 'center',
                    //             text: 'Kop Surat Anda'
                    //         });

                    //         doc.footer = function(currentPage, pageCount) {
                    //             return {
                    //                 margin: [10, 0],
                    //                 columns: [{
                    //                         alignment: 'left',
                    //                         text: 'Dicetak pada tanggal ' + moment().format(
                    //                                 'DD-MM-YYYY') +
                    //                             ' | Saldo Akhir: ' + $('#endingBalance')
                    //                             .text()
                    //                     },
                    //                     {
                    //                         alignment: 'right',
                    //                         text: 'Halaman ' + currentPage.toString() +
                    //                             ' dari ' + pageCount.toString()
                    //                     }
                    //                 ]
                    //             };
                    //         };
                    //     }
                    // },
                    {
                        extend: 'print',
                        className: 'btn btn-info',
                        text: '<i class="fas fa-print"></i> Print',
                        layout: 'landscape',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                            title: ''
                        },
                        customize: function(win) {
                            $(win.document.body).find('.dt-title').remove();
                            dayjs.locale('id');

                            var fromDate = dayjs($('input[name="from_date"]').val()).format(
                                'DD MMMM YYYY');
                            var toDate = dayjs($('input[name="to_date"]').val()).format(
                                'DD MMMM YYYY');
                            $(win.document.body).prepend(
                                '<img src="{{ asset('assets/img/kop_surat.png') }}" style="width: 100%;" /><br><br> <h2 style="text-align: center;"><b>Laporan Penerimaan dan Pengeluaran Kas</b></h2> <br> <p style="text-align: right;">Tanggal Dicetak: ' +
                                dayjs().format('DD MMMM YYYY') +
                                '</p><br> <span style="text-align: left;">Tanggal Awal: ' +
                                fromDate +
                                '<br>Tanggal Awal:  ' +
                                toDate +
                                '</span> <br><br>'
                            );
                            $(win.document.body).append(
                                '<br><div style="text-align: left;">Saldo Akhir: <span id="endingBalance"></span></div>'
                            );
                            $(win.document.body).append(
                                '<div style="width:95%; float: right; margin-right:5%;"><strong><table style="float: right; text-align:center;"><tr style="width:10%;"><td>Dibuat Oleh,</td></tr><tr><td style="height: 50px;"></td><tr><td>{{ ucwords(Auth::user()->nama) }}({{ ucwords(Auth::user()->role) }})</td></tr></table></b></div>'
                            );
                        }
                    },
                ],
                ajax: {
                    url: "{{ route('laporan.list') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: function(d) {
                        d.from_date = $('input[name="from_date"]').val();
                        d.to_date = $('input[name="to_date"]').val();
                        d.filter_data = $('select[name="filter_data"]').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'no_transaksi',
                        name: 'no_transaksi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'penerimaan',
                        name: 'penerimaan',
                        className: 'text-right',
                        render: function(data, type, full, meta) {
                            if (data === '-') {
                                return data;
                            } else {
                                return parseFloat(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        }
                    },
                    {
                        data: 'pengeluaran',
                        name: 'pengeluaran',
                        className: 'text-right',
                        render: function(data, type, full, meta) {
                            if (data === '-') {
                                return data;
                            } else {
                                return parseFloat(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        }
                    },
                    {
                        data: 'saldo',
                        name: 'saldo',
                        className: 'text-right',
                        render: function(data, type, full, meta) {
                            if (data === '-') {
                                return data;
                            } else {
                                return parseFloat(data).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        }
                    },
                ],
                language: {
                    processing: "Sedang memproses...",
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Data kosong",
                }
            });
        });
    </script>
@endsection
