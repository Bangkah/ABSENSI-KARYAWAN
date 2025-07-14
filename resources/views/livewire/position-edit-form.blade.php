<div>
    <form wire:submit.prevent="savePositions" method="post">

        {{-- Tampilkan pesan kesalahan jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Jabatan --}}
        @foreach ($positions as $position)
            <div class="mb-3">
                <x-form-label id="name{{ $position['id'] }}"
                    label="Nama Jabatan ke-{{ $loop->iteration }} (ID: {{ $position['id'] }})" />
                <div class="d-flex align-items-center">
                    <x-form-input
                        id="name{{ $position['id'] }}"
                        name="name{{ $position['id'] }}"
                        placeholder="Contoh: Manajer, Supervisor, Staf HR"
                        wire:model.defer="positions.{{ $loop->index }}.name"
                    />
                </div>
                <x-form-error key="positions.{{ $loop->index }}.name" />
            </div>
        @endforeach

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                Simpan Perubahan
                <span wire:loading wire:target="savePositions" class="ms-1">⏳</span>
            </button>
        </div>
    </form>
</div>
