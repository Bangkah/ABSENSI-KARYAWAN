<div>
    <form wire:submit.prevent="save" method="post" novalidate>
        @include('partials.alerts')

        <div class="w-100">

            {{-- Nama/Judul Absensi --}}
            <div class="mb-3">
                <x-form-label id="title" label="Nama atau Judul Absensi" />
                <x-form-input id="title" name="title" wire:model.defer="attendance.title" />
                <x-form-error key="attendance.title" />
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <x-form-label id="description" label="Keterangan (Opsional)" />
                <textarea id="description" name="description" class="form-control"
                    wire:model.defer="attendance.description"></textarea>
                <x-form-error key="attendance.description" />
            </div>

            {{-- Waktu Absen Masuk --}}
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="start_time" label="Jam Masuk (Absen Datang)" />
                        <x-form-input type="text" maxlength="5" id="start_time" name="start_time"
                            wire:model.defer="attendance.start_time" placeholder="Contoh: 07:00" />
                        <x-form-error key="attendance.start_time" />
                    </div>
                    <div class="col-md-6">
                        <x-form-label id="batas_start_time" label="Batas Terakhir Absen Masuk" />
                        <x-form-input type="text" maxlength="5" id="batas_start_time" name="batas_start_time"
                            wire:model.defer="attendance.batas_start_time" placeholder="Contoh: 08:00" />
                        <x-form-error key="attendance.batas_start_time" />
                    </div>
                </div>
                <small class="text-muted d-block mt-1">Masukkan jam dengan format 24 jam (contoh: 13:30 untuk jam 1 siang).</small>
            </div>

            {{-- Waktu Absen Pulang --}}
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="end_time" label="Jam Pulang (Absen Keluar)" />
                        <x-form-input type="text" maxlength="5" id="end_time" name="end_time"
                            wire:model.defer="attendance.end_time" placeholder="Contoh: 16:00" />
                        <x-form-error key="attendance.end_time" />
                    </div>
                    <div class="col-md-6">
                        <x-form-label id="batas_end_time" label="Batas Terakhir Absen Pulang" />
                        <x-form-input type="text" maxlength="5" id="batas_end_time" name="batas_end_time"
                            wire:model.defer="attendance.batas_end_time" placeholder="Contoh: 17:00" />
                        <x-form-error key="attendance.batas_end_time" />
                    </div>
                </div>
                <small class="text-muted d-block mt-1">Masukkan jam dengan format 24 jam (contoh: 18:00).</small>
            </div>

            {{-- Posisi Karyawan --}}
            <div class="mb-3">
                <x-form-label id="positions" label="Posisi Karyawan yang Menggunakan Absensi Ini" />
                <div class="row ms-1">
                    @foreach ($positions as $position)
                        <div class="form-check col-sm-4">
                            <input class="form-check-input" type="checkbox" value="{{ $position->id }}"
                                wire:model.defer="position_ids.{{ $position->id }}"
                                id="flexCheckPosition{{ $loop->index }}">
                            <label class="form-check-label" for="flexCheckPosition{{ $loop->index }}">
                                {{ $position->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <small class="text-muted d-block mt-1">Pilih posisi/jabatan karyawan yang dapat menggunakan absensi ini.</small>
                <x-form-error key="position_ids" />
            </div>

            {{-- Pilihan QRCode --}}
            <div class="mb-3">
                <x-form-label id="flexCheckCode" label="Gunakan QRCode untuk Absen?" />
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" wire:model="attendance.code"
                        id="flexCheckCode">
                    <label class="form-check-label" for="flexCheckCode">
                        Ya, aktifkan QRCode untuk absen
                    </label>
                    <small class="text-muted d-block mt-1">Jika ini dicentang, maka absensi akan menggunakan QRCode (bukan tombol biasa).</small>
                    <x-form-error key="attendance.code" />
                </div>
            </div>

        </div>

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan Pengaturan Absensi
            </button>
        </div>
    </form>
</div>
