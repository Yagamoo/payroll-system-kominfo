@extends('template.layout')

@section('title')
    Jabatan
@endsection

@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('sidebar')
    <li>
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
    </li>
    <li class="nav-divider"></li>
    <li class="active">
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
    <li>
        <a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i> <span class="nav-label">Gaji</span></a>
    </li>
@endsection

@section('breadcrumb')
    <div class="col-lg-10">
        <h2 class="mt-0">Tambah Jabatan</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('jabatan.index') }}">Jabatan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Tambah Jabatan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title bg-pattern">
                <h5 class="m-0">Data Jabatan</h5>
            </div>
            <div class="ibox-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" placeholder="Contoh: Staff IT"
                            value="{{ old('nama_jabatan') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" step="0.01"
                            placeholder="Contoh: 3000000" value="{{ old('gaji_pokok') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fa fa-save"></i> Simpan
                    </button>

                    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary mt-3">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
