@extends('template.layout')

@section('title')
    Pegawai
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
    <li class="active">
        <a href="{{ route('pegawai.index') }}"><i class="fa fa-line-chart"></i> <span class="nav-label">Pegawai</span></a>
    </li>
    <li>
        <a href="{{ route('presensi.index') }}"><i class="fa fa-check-square-o"></i> <span
                class="nav-label">Presensi</span></a>
    </li>
    <li class="nav-divider"></li>
    <li>
        <a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i> <span class="nav-label">Gaji</span></a>
    </li>
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2 class="mt-0">Pegawai</h2>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li> --}}
            <li class="breadcrumb-item active">
                <strong>Pegawai</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title p-3 d-flex justify-content-between align-items-center bg-pattern">
                <h5 class="m-0">Data Pegawai</h5>
                <div>
                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Tambah Pegawai</a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="data-pegawai" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gelar</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->gelar }}</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('pegawai.edit', $item->id_pegawai) }}"
                                                class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('pegawai.destroy', $item->id_pegawai) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gelar</th>
                                <th>Jabatan</th>
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
