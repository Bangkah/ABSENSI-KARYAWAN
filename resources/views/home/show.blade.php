@extends('layouts.home')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="mb-2">
                @include('partials.attendance-badges')
            </div>
            @include('partials.alerts')

            <h1 class="fs-2">{{ $attendance->title }}</h1>
            <p class="text-muted">{{ $attendance->description }}</p>

            <div class="mb-4">
                <span class="badge text-bg-light border shadow-sm">Masuk : {{
                    substr($attendance->data->start_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_start_time,0,-3 )}}</span>
                <span class="badge text-bg-light border shadow-sm">Pulang : {{
                    substr($attendance->data->end_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_end_time,0,-3 )}}</span>
            </div>

            @if (!$attendance->data->is_using_qrcode)
                <livewire:presence-form :attendance="$attendance" :data="$data" :holiday="$holiday" />
            @else
                <div class="card border shadow-sm mb-3">
                    <div class="card-body">
                        <h5>Absensi Menggunakan QR Code</h5>

                        <div id="reader" style="width: 100%; max-width: 400px;"></div>
                        <div id="qrcode-result" class="mt-3 text-success fw-bold"></div>

                        <form id="qrcode-form" method="POST" action="{{ route('home.sendEnterPresenceUsingQRCode') }}">
                            @csrf
                            <input type="hidden" name="code" id="qr-code-input">
                        </form>

                        <hr>

                        <button class="btn btn-success w-100 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#qrcode-scanner-modal" data-is-enter="1">
                            <i class="bi bi-qr-code-scan me-1"></i> Scan QRCode untuk Absen Masuk
                        </button>

                        <h6 class="mt-4">Atau Masukkan Kode Manual</h6>
                        <form method="POST" action="{{ route('home.sendEnterPresenceUsingQRCode') }}">
                            @csrf
                            <div class="input-group mt-2">
                                <input type="text" name="code" class="form-control" placeholder="Masukkan kode absensi secara manual" required>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h5 class="mb-3">Histori 30 Hari Terakhir</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Pulang</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($priodDate as $date)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @php
                                $histo = $history->where('presence_date', $date)->first();
                            @endphp
                            @if (!$histo)
                                <td>{{ $date }}</td>
                                <td colspan="3">
                                    @if($date == now()->toDateString())
                                        <div class="badge text-bg-info">Belum Hadir</div>
                                    @else
                                        <div class="badge text-bg-danger">Tidak Hadir</div>
                                    @endif
                                </td>
                            @else
                                <td>{{ $histo->presence_date }}</td>
                                <td>{{ $histo->presence_enter_time }}</td>
                                <td>
                                    @if($histo->presence_out_time)
                                        {{ $histo->presence_out_time }}
                                    @else
                                        <span class="badge text-bg-danger">Belum Absensi Pulang</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($histo->is_permission)
                                        <div class="badge text-bg-warning">Izin</div>
                                    @else
                                        <div class="badge text-bg-success">Hadir</div>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal QRCode -->
<div class="modal fade" id="qrcode-scanner-modal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QRCode Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="reader"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('html5-qrcode/html5-qrcode.min.js') }}"></script>
<script>
    const enterPresenceUrl = "{{ route('home.sendEnterPresenceUsingQRCode') }}";
    const outPresenceUrl = "{{ route('home.sendOutPresenceUsingQRCode') }}";
</script>
<script type="module" src="{{ asset('js/home/qrcode.js') }}"></script>
@endpush
