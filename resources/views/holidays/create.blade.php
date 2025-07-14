@extends('layouts.app')

@section('buttons')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div>
            <a href="{{ route('holidays.index') }}" class="btn btn-sm btn-light d-flex align-items-center shadow-sm">
                <i data-feather="arrow-left-circle" class="me-1"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i data-feather="calendar-plus" class="me-2"></i> Tambah Hari Libur Baru
                </div>
                <div class="card-body">
                    <livewire:holiday-create-form />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace(); // Menampilkan ikon
    </script>
@endpush
