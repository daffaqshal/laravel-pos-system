<div class="space-y-4">
        <div>
            <label for="supplier_number" class="block text-sm font-medium text-gray-700">
                No Supplier
            </label>
            <input
                type="text"
                name="supplier_number"
                id="supplier_number"
                value="{{ old('supplier_number', $activeSupplier->supplier_number ?? '') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
                required
                @disabled($isViewMode)
            >
            @error('supplier_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="pic_name" class="block text-sm font-medium text-gray-700">
                Nama PIC
            </label>
            <input
                type="text"
                name="pic_name"
                id="pic_name"
                value="{{ old('pic_name', $activeSupplier->pic_name ?? '') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
                required
                @disabled($isViewMode)
            >
            @error('pic_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">
                Alamat
            </label>
            <textarea
                name="address"
                id="address"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
                required
                @disabled($isViewMode)
            >{{ old('address', $activeSupplier->address ?? '') }}</textarea>
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end gap-2 border-t pt-4">
        <a
            href="{{ route('suppliers.index') }}"
            class="rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600"
        >
            Tutup
        </a>

        @unless ($isViewMode)
            <button
                type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700"
            >
                {{ $editSupplier ? 'Update Supplier' : 'Simpan Supplier' }}
            </button>
        @endunless
    </div>