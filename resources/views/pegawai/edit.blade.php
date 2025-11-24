@extends('template.layout')

@section('title')
    Edit Pegawai
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
        <h2 class="mt-0"> Edit Pegawai</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('pegawai.index') }}">Pegawai</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Edit Pegawai</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
@endsection

@section('content')
    <div class="col-12">
        <div class="ibox ">
            <div class="ibox-title bg-pattern">
                <h5 class="m-0">Data Pegawai</h5>
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

                <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label>Gelar</label>
                        <select name="gelar" class="form-control" required>
                            <option value="D3" {{ $pegawai->gelar == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $pegawai->gelar == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $pegawai->gelar == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="id_jabatan" class="form-control" required>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id_jabatan }}"
                                    {{ $pegawai->id_jabatan == $jabatan->id_jabatan ? 'selected' : '' }}>
                                    {{ $jabatan->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
