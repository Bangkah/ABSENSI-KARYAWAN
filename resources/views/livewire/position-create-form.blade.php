<div>
    <form wire:submit.prevent="savePositions" method="post">

        {{-- Pesan error jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Daftar Input Jabatan --}}
        @foreach ($positions as $i => $position)
            <div class="mb-3">
                <x-form-label id="name{{ $i }}" label="Nama Jabatan {{ $i + 1 }}" />
                <div class="d-flex align-items-center">
                    <x-form-input id="name{{ $i }}" name="name{{ $i }}"
                        placeholder="Contoh: Manajer, Staff Admin, dll"
                        wire:model.defer="positions.{{ $i }}.name" />
                    
                    {{-- Tombol Hapus (kecuali input pertama) --}}
                    @if ($i > 0)
                        <button class="btn btn-sm btn-danger ms-2"
                            type="button"
                            wire:click="removePositionInput({{ $i }})"
                            wire:target="removePositionInput({{ $i }})"
                            wire:loading.attr="disabled">
                            Hapus
                        </button>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button class="btn btn-primary">
                Simpan Jabatan
            </button>
            <button class="btn btn-light" type="button" wire:click="addPositionInput" wire:loading.attr="disabled">
                Tambah Kolom
            </button>
        </div>
    </form>
</div>
