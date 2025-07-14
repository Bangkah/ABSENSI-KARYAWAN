@extends('layouts.app')

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('positions.index') }}" class="btn btn-sm btn-light">
                <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
                Kembali ke Daftar Jabatan
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            {{-- Formulir untuk menambahkan data jabatan baru --}}
            <h4 class="mb-4">Tambah Data Jabatan</h4>
            <livewire:position-create-form />
        </div>
    </div>
@endsection
