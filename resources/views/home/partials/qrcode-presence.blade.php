<div>
    @if ($holiday)
        <div class="alert alert-success">
            <small class="fw-bold">Hari ini adalah hari libur.</small>
        </div>
    @else
        @if ($attendance->data->is_using_qrcode && !$data['is_there_permission'])

            {{-- Tombol QR Code Absen Masuk --}}
            @if ($attendance->data->is_start && !$data['is_has_enter_today'])
                <button class="btn btn-primary d-block w-100 mb-2"
                    data-bs-toggle="modal"
                    data-bs-target="#qrcode-scanner-modal"
                    data-is-enter="1">Scan QRCode Masuk</button>

                <form action="{{ route('home.sendEnterPresenceUsingQRCode') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="text" name="code" class="form-control mb-2" placeholder="Masukkan kode QR manual">
                    <button type="submit" class="btn btn-outline-primary w-100">Submit Manual</button>
                </form>

                <a href="{{ route('home.permission', $attendance->id) }}"
                    class="btn btn-info d-block w-100 mt-2">Ajukan Izin</a>
            @endif

            {{-- Sudah Absen Masuk --}}
            @if ($data['is_has_enter_today'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Sudah absen masuk.</small>
                </div>
            @endif

            {{-- QR Code Pulang --}}
            @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'])
                <button class="btn btn-primary d-block w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#qrcode-scanner-modal"
                    data-is-enter="0">Scan QRCode Pulang</button>

                <form action="{{ route('home.sendOutPresenceUsingQRCode') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="text" name="code" class="form-control mb-2" placeholder="Masukkan kode QR manual">
                    <button type="submit" class="btn btn-outline-primary w-100">Submit Manual Pulang</button>
                </form>
            @endif

            {{-- Sudah Absen Pulang --}}
            @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Sudah absen masuk dan pulang.</small>
                </div>
            @endif

            {{-- Belum waktunya absen pulang --}}
            @if ($data['is_has_enter_today'] && !$attendance->data->is_end)
                <div class="alert alert-danger">
                    <small class="fw-bold">Belum saatnya absen pulang.</small>
                </div>
            @endif

        @endif

        @if($data['is_there_permission'] && !$data['is_permission_accepted'])
            <div class="alert alert-info">
                <small class="fw-bold">Izin sedang diproses.</small>
            </div>
        @endif

        @if($data['is_there_permission'] && $data['is_permission_accepted'])
            <div class="alert alert-success">
                <small class="fw-bold">Izin disetujui.</small>
            </div>
        @endif
    @endif

    {{-- Modal Scan QR --}}
    <div class="modal fade" id="qrcode-scanner-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scan QRCode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="reader"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script>
        const enterPresenceUrl = "{{ route('home.sendEnterPresenceUsingQRCode') }}";
        const outPresenceUrl = "{{ route('home.sendOutPresenceUsingQRCode') }}";
    </script>
    <script type="module" src="{{ asset('js/home/qrcode.js') }}"></script>
@endpush
