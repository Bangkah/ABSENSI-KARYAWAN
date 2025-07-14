<div>
    <form wire:submit.prevent="save" method="post" novalidate>
        @include('partials.alerts')

        <div class="w-100">

            {{-- Judul atau Alasan Utama --}}
            <div class="mb-3">
                <x-form-label id="title" label="Judul atau Alasan Utama Izin" />
                <x-form-input id="title" name="title"
                    placeholder="Contoh: Izin Sakit, Izin Keluarga, dll"
                    wire:model.defer="permission.title" />
                <x-form-error key="permission.title" />
            </div>

            {{-- Keterangan Tambahan --}}
            <div class="mb-3">
                <x-form-label id="description" label="Keterangan Lebih Lengkap (Opsional)" />
                <textarea id="description" name="description" class="form-control"
                    placeholder="Contoh: Saya sedang sakit demam dan harus istirahat total di rumah."
                    wire:model.defer="permission.description"></textarea>
                <x-form-error key="permission.description" />
            </div>

        </div>

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button class="btn btn-primary">
                Simpan Izin
            </button>
        </div>
    </form>
</div>
