@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success shadow-sm d-flex align-items-center">
                <i data-feather="plus-circle" class="me-1"></i> Tambah Data Karyawan
            </a>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alerts')

    <div class="card shadow-sm">
        <div class="card-body">
            <livewire:employee-table />
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    @powerGridScripts
@endpush
