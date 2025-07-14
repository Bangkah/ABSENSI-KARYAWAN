<div>
    <form wire:submit.prevent="saveEmployees" method="post" novalidate>
        @include('partials.alerts')

        @foreach ($employees as $i => $employee)
        <div class="mb-3 border rounded p-3 shadow-sm bg-white">
            <h6 class="fw-bold mb-3">Data Karyawan ke-{{ $i + 1 }}</h6>

            {{-- Nama --}}
            <div class="mb-3">
                <x-form-label id="name{{ $i }}" label="Nama Lengkap" />
                <x-form-input id="name{{ $i }}" name="name{{ $i }}" wire:model.defer="employees.{{ $i }}.name" />
                <x-form-error key="employees.{{ $i }}.name" />
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <x-form-label id="email{{ $i }}" label="Alamat Email" />
                <x-form-input id="email{{ $i }}" name="email{{ $i }}" type="email"
                    wire:model.defer="employees.{{ $i }}.email" placeholder="contoh@email.com" />
                <x-form-error key="employees.{{ $i }}.email" />
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-3">
                <x-form-label id="phone{{ $i }}" label="Nomor Telepon" />
                <x-form-input id="phone{{ $i }}" name="phone{{ $i }}"
                    wire:model.defer="employees.{{ $i }}.phone" placeholder="Contoh: 08xxxxxxxxxx" />
                <x-form-error key="employees.{{ $i }}.phone" />
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <x-form-label id="password{{ $i }}" label="Kata Sandi (opsional)" required="false" />
                <x-form-input id="password{{ $i }}" name="password{{ $i }}"
                    wire:model.defer="employees.{{ $i }}.password" required="false"
                    placeholder='Kosongkan jika ingin pakai default "123"' />
                <x-form-error key="employees.{{ $i }}.password" />
            </div>

            {{-- Posisi / Jabatan --}}
            <div class="mb-3">
                <x-form-label id="position_id{{ $i }}" label="Jabatan / Posisi" />
                <select class="form-select" name="position_id"
                    wire:model.defer="employees.{{ $i }}.position_id">
                    <option selected disabled>-- Pilih Posisi --</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ ucfirst($position->name) }}</option>
                    @endforeach
                </select>
                <x-form-error key="employees.{{ $i }}.position_id" />
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <x-form-label id="role_id{{ $i }}" label="Peran (Role)" />
                <select class="form-select" name="role_id"
                    wire:model.defer="employees.{{ $i }}.role_id">
                    <option selected disabled>-- Pilih Peran --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                <x-form-error key="employees.{{ $i }}.role_id" />
            </div>

            {{-- Tombol Hapus --}}
            @if ($i > 0)
            <button type="button" class="btn btn-sm btn-danger"
                wire:click="removeEmployeeInput({{ $i }})" wire:loading.attr="disabled">
                Hapus Karyawan Ini
            </button>
            @endif
        </div>
        @endforeach

        <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
            <button class="btn btn-primary">
                Simpan Semua Data
            </button>
            <button class="btn btn-outline-secondary" type="button"
                wire:click="addEmployeeInput" wire:loading.attr="disabled">
                Tambah Form Karyawan
            </button>
        </div>
    </form>
</div>
