@extends('template.layout')

@section('title')
    Gaji
@endsection

@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('sidebar')
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
    </li>
    <li class="nav-divider"></li>
    <li>
        <a href="{{ route('jabatan.index') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Jabatan</span></a>
    </li>
    <li>
        <a href="{{ route('pegawai.index') }}"><i class="fa fa-line-chart"></i> <span class="nav-label">Pegawai</span></a>
    </li>
    <li>
        <a href="{{ route('presensi.index') }}"><i class="fa fa-check-square-o"></i> <span
                class="nav-label">Presensi</span></a>
    </li>
    <li class="nav-divider"></li>
    <li class="active">
        <a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i> <span class="nav-label">Gaji</span></a>
    </li>
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2 class="mt-0">Gaji</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Gaji</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title bg-pattern">
                <h5 class="m-0">Filter</h5>
            </div>
            <div class="ibox-content">
                <form method="GET" action="{{ route('gaji.index') }}" class="mb-3 d-flex gap-2">
                    <input type="month" name="bulan" value="{{ request('bulan') ?? date('Y-m') }}" class="form-control mr-3"
                        style="max-width: 200px;">
                    <button class="btn btn-primary mr-3">Filter</button>
                    <a href="{{ route('gaji.index') }}" class="btn btn-danger">Hapus Filter</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title bg-pattern">
                <h5 class="m-0">Data Pegawai</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="data-gaji" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gelar</th>
                                <th>Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Total Potongan</th>
                                <th>Total Lembur</th>
                                <th>Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->gelar }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td>{{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->total_potongan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->total_lembur, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->gaji_bersih, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#data-gaji').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'copy'
                    },
                    {
                        extend: 'csv'
                    },
                    {
                        extend: 'excel',
                        title: 'ExampleFile'
                    },
                    {
                        extend: 'pdf',
                        title: 'ExampleFile'
                    },

                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });
    </script>
@endsection
