@extends('layouts.app')

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-secondary shadow-sm d-flex align-items-center">
                <i data-feather="arrow-left-circle" class="me-1"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alerts')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i data-feather="user-plus" class="me-2"></i> Tambah Data Karyawan
                </div>
                <div class="card-body">
                    <livewire:employee-create-form />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endpush
