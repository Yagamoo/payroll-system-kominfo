@extends('template.layout')

@section('title')
    Tambah Presensi
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
        <h2 class="mt-0"> Tambah Presensi</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('presensi.index') }}">Presensi</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Tambah Presensi</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title bg-pattern">
                <h5 class="m-0">Data Presensi</h5>
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

                <form action="{{ route('presensi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pegawai</label>
                <select name="id_pegawai" class="form-control" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach($pegawais as $p)
                        <option value="{{ $p->id_pegawai }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Status Kehadiran</label>
                <select name="status_hadir" class="form-control" required>
                    <option value="hadir">Hadir</option>
                    <option value="alpa">Alpa</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jam Masuk</label>
                <input type="time" name="jam_masuk" class="form-control">
            </div>

            <div class="form-group">
                <label>Jam Keluar</label>
                <input type="time" name="jam_keluar" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
