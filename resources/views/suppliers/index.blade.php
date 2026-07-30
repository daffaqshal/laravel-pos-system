<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Supplier
        </h2>
    </x-slot>

    <div class="py-8 mt-2">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif -->

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Data Supplier</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Kelola data supplier untuk transaksi pembelian.
                        </p>
                    </div>

                    <a
                        href="{{ route('suppliers.index', ['create' => 1]) }}"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700"
                    >
                        + Tambah Supplier
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">No Supplier</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama PIC</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">Alamat</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($suppliers as $supplier)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $supplier->supplier_number }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $supplier->pic_name }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $supplier->address }}
                                    </td>
                                   <td class="border border-gray-300 px-4 py-3 text-right text-sm whitespace-nowrap">
                                        <a
                                            href="{{ route('suppliers.index', ['view' => $supplier->id]) }}"
                                            class="inline-flex rounded-md bg-gray-600 px-3 py-1 text-xs font-semibold text-white"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('suppliers.index', ['edit' => $supplier->id]) }}"
                                            class="ml-2 inline-flex rounded-md bg-yellow-500 px-3 py-1 text-xs font-semibold text-white"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('suppliers.destroy', $supplier) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus supplier ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="ml-2 inline-flex rounded-md bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-700"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada data supplier.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>

    @if ($showModal)
        @php
            $activeSupplier = $editSupplier ?? $viewSupplier;
            $isViewMode = filled($viewSupplier);
        @endphp

        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-xl">
                <div class="flex items-center justify-between border-b px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        @if ($isViewMode)
                            Detail Supplier
                        @elseif ($editSupplier)
                            Edit Supplier
                        @else
                            Tambah Supplier
                        @endif
                    </h3>

                    <a href="{{ route('suppliers.index') }}" class="text-2xl leading-none text-gray-500 hover:text-gray-700">
                        &times;
                    </a>
                </div>

                <form
                    action="{{ $editSupplier ? route('suppliers.update', $editSupplier) : route('suppliers.store') }}"
                    method="POST"
                    class="p-6"
                >
                    @csrf

                    @if ($editSupplier)
                        @method('PUT')
                    @endif

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
                </form>
            </div>
        </div>
    @endif
</x-app-layout>