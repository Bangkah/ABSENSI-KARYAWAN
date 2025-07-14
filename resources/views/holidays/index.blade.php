@extends('layouts.app')

@push('style')
    @powerGridStyles
@endpush

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('holidays.create') }}" class="btn btn-sm btn-primary d-flex align-items-center shadow-sm">
                <i data-feather="plus-circle" class="me-1"></i> Tambah Data Hari Libur
            </a>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alerts')

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i data-feather="calendar" class="me-2"></i> Daftar Hari Libur
        </div>
        <div class="card-body">
            <livewire:holiday-table />
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    @powerGridScripts
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endpush
