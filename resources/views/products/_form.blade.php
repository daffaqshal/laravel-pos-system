<div class="space-y-4">

    {{-- Kode Barang --}}
    <div>
        <label for="product_code" class="block text-sm font-medium text-gray-700">
            Kode Barang
        </label>

        <input
            type="text"
            name="product_code"
            id="product_code"
            value="{{ old('product_code', $activeProduct->product_code ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
            required
            @disabled($isViewMode)
        >

        @error('product_code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Nama Barang --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">
            Nama Barang
        </label>

        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $activeProduct->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
            required
            @disabled($isViewMode)
        >

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggal Expired --}}
    <div>
        <label for="expired_date" class="block text-sm font-medium text-gray-700">
            Tanggal Expired
        </label>

        <input
            type="date"
            name="expired_date"
            id="expired_date"
            value="{{ old('expired_date', $activeProduct?->expired_date?->format('Y-m-d')) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
            @disabled($isViewMode)
        >

        @error('expired_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Stock --}}
    <div>
        <label for="stock" class="block text-sm font-medium text-gray-700">
            Stock
        </label>

        <input
            type="number"
            name="stock"
            id="stock"
            min="0"
            value="{{ old('stock', $activeProduct->stock ?? 0) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
            required
            @disabled($isViewMode)
        >

        @error('stock')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Harga --}}
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700">
            Harga
        </label>

        <input
            type="number"
            name="price"
            id="price"
            min="0"
            step="0.01"
            value="{{ old('price', $activeProduct->price ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100"
            required
            @disabled($isViewMode)
        >

        @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="mt-6 flex justify-end gap-2 border-t pt-4">

    <a
        href="{{ route('products.index') }}"
        class="rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600"
    >
        Tutup
    </a>

    @unless($isViewMode)
        <button
            type="submit"
            class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700"
        >
            {{ $editProduct ? 'Update Barang' : 'Simpan Barang' }}
        </button>
    @endunless

</div>