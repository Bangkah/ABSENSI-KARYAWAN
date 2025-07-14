<div>
    {{-- Jika Hari Ini Libur --}}
    @if ($holiday)
        <div class="alert alert-success">
            <small class="fw-bold">Hari ini kamu libur. Nikmati harinya ya!</small>
        </div>
    @else

        {{-- Jika tidak pakai QR dan belum mengajukan izin --}}
        @if (!$attendance->data->is_using_qrcode && !$data['is_there_permission'])

            {{-- Jika belum absen masuk dan waktunya sudah dimulai --}}
            @if ($attendance->data->is_start && !$data['is_has_enter_today'])
                <button class="btn btn-primary px-3 py-2 btn-sm fw-bold d-block w-100 mb-2"
                    wire:click="sendEnterPresence"
                    wire:loading.attr="disabled"
                    wire:target="sendEnterPresence">
                    Absen Masuk
                </button>
                <a href="{{ route('home.permission', $attendance->id) }}"
                    class="btn btn-info px-3 py-2 btn-sm fw-bold d-block w-100">
                    Ajukan Izin
                </a>
            @endif

            {{-- Jika sudah absen masuk --}}
            @if ($data['is_has_enter_today'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Kamu sudah absen masuk hari ini.</small>
                </div>
            @endif

            {{-- Jika waktunya absen pulang --}}
            @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'])
                <button class="btn btn-primary px-3 py-2 btn-sm fw-bold d-block w-100"
                    wire:click="sendOutPresence"
                    wire:loading.attr="disabled"
                    wire:target="sendOutPresence">
                    Absen Pulang
                </button>
            @endif

            {{-- Jika sudah absen masuk & pulang --}}
            @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
                <div class="alert alert-success">
                    <small class="d-block fw-bold text-success">Kamu sudah absen masuk dan absen pulang. Terima kasih!</small>
                </div>
            @endif

            {{-- Jika sudah absen masuk tapi belum waktunya absen pulang --}}
            @if ($data['is_has_enter_today'] && !$attendance->data->is_end)
                <div class="alert alert-danger">
                    <small class="fw-bold">Belum waktunya untuk absen pulang. Silakan tunggu ya.</small>
                </div>
            @endif
        @endif

        {{-- Jika sudah mengajukan izin tapi belum disetujui --}}
        @if ($data['is_there_permission'] && !$data['is_permission_accepted'])
            <div class="alert alert-info">
                <small class="fw-bold">Izin kamu sedang diproses. Mohon tunggu konfirmasi ya.</small>
            </div>
        @endif

        {{-- Jika izin sudah disetujui --}}
        @if ($data['is_there_permission'] && $data['is_permission_accepted'])
            <div class="alert alert-success">
                <small class="fw-bold">Izin kamu sudah disetujui. Terima kasih sudah memberitahu.</small>
            </div>
        @endif

    @endif
</div>
