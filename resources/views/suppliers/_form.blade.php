<!-- <div>
    <label for="supplier_number" class="block text-sm font-medium text-gray-700">No Supplier</label>
    <input
        type="text"
        name="supplier_number"
        id="supplier_number"
        value="{{ old('supplier_number', $supplier->supplier_number ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required
    >
    @error('supplier_number')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4">
    <label for="pic_name" class="block text-sm font-medium text-gray-700">Nama PIC</label>
    <input
        type="text"
        name="pic_name"
        id="pic_name"
        value="{{ old('pic_name', $supplier->pic_name ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required
    >
    @error('pic_name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4">
    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
    <textarea
        name="address"
        id="address"
        rows="4"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        required
    >{{ old('address', $supplier->address ?? '') }}</textarea>
    @error('address')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div> -->