@extends('template.layout')

@section('title')
    Presensi
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
    <li class="active">
        <a href="{{ route('presensi.index') }}"><i class="fa fa-check-square-o"></i> <span class="nav-label">Presensi</span></a>
    </li>
        <li class="nav-divider"></li>
    <li>
        <a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i> <span class="nav-label">Gaji</span></a>
    </li>
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2 class="mt-0">Presensi</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Presensi</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title p-3 d-flex justify-content-between align-items-center bg-pattern">
                    <h5 class="m-0">Data Presensi</h5>
                    <div>
                        <a href="{{ route('presensi.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Tambah Pegawai</a>
                    </div>
                </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="data-pegawai" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pegawai</th>
                                <th>Tanggal</th>
                                <th>Kehadiran</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Terlambat (menit)</th>
                                <th>Lembur(menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->pegawai->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $item->status_hadir }}</td>
                                    <td>{{ $item->jam_masuk ?? '-' }}</td>
                                    <td>{{ $item->jam_keluar ?? '-' }}</td>
                                    <td>{{ $item->terlambat_menit }}</td>
                                    <td>{{ $item->lembur_menit }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('presensi.edit', $item->id_presensi) }}" class="btn btn-sm btn-warning"><i
                                                    class="fa fa-pencil"></i></a>
                                            <form action="{{ route('presensi.destroy', $item->id_presensi) }}" 
      method="POST" 
      class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" 
            onclick="return confirm('Yakin ingin menghapus data ini?')">
        Hapus
    </button>
</form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Pegawai</th>
                                <th>Tanggal</th>
                                <th>Kehadiran</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Terlambat (menit)</th>
                                <th>Lembur(menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
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
            $('#data-pegawai').DataTable({
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
