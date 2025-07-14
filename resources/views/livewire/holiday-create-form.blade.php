<div>
    <form wire:submit.prevent="saveHolidays" method="post" novalidate>
        @include('partials.alerts')

        @foreach ($holidays as $i => $holiday)
        <div class="mb-4 border rounded p-3 shadow-sm bg-white">
            <h6 class="fw-bold mb-3">Hari Libur ke-{{ $i + 1 }}</h6>

            {{-- Nama Hari Libur --}}
            <div class="mb-3">
                <x-form-label id="title{{ $i }}" label="Nama / Judul Hari Libur" />
                <x-form-input id="title{{ $i }}" name="title{{ $i }}"
                    wire:model.defer="holidays.{{ $i }}.title" />
                <x-form-error key="holidays.{{ $i }}.title" />
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <x-form-label id="description{{ $i }}" label="Keterangan Tambahan" />
                <textarea id="description{{ $i }}" name="description{{ $i }}" class="form-control"
                    wire:model.defer="holidays.{{ $i }}.description" placeholder="Contoh: Libur Nasional, Cuti Bersama, dll"></textarea>
                <x-form-error key="holidays.{{ $i }}.description" />
            </div>

            {{-- Tanggal Hari Libur --}}
            <div class="mb-3">
                <x-form-label id="holiday_date{{ $i }}" label="Tanggal Hari Libur" />
                <x-form-input type="date" id="holiday_date{{ $i }}" name="holiday_date{{ $i }}"
                    wire:model.defer="holidays.{{ $i }}.holiday_date" />
                <small class="text-muted d-block mt-2">
                    Pilih tanggal sesuai hari libur yang ditentukan.
                </small>
                <x-form-error key="holidays.{{ $i }}.holiday_date" />
            </div>

            {{-- Tombol Hapus --}}
            @if ($i > 0)
            <button class="btn btn-sm btn-danger mt-2" type="button"
                wire:click="removeHolidayInput({{ $i }})"
                wire:loading.attr="disabled">
                Hapus Hari Libur Ini
            </button>
            @endif
        </div>
        @endforeach

        {{-- Tombol Simpan dan Tambah --}}
        <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
            <button class="btn btn-primary">
                Simpan Semua
            </button>
            <button class="btn btn-light" type="button"
                wire:click="addHolidayInput"
                wire:loading.attr="disabled">
                Tambah Baris Hari Libur
            </button>
        </div>
    </form>
</div>
