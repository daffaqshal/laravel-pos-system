<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Barang
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Data Barang</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Kelola data barang untuk transaksi penjualan dan pembelian.
                        </p>
                    </div>

                    <a
                        href="{{ route('products.index', ['create' => 1]) }}"
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700"
                    >
                        + Tambah Barang
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Kode Barang
                                </th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Nama Barang
                                </th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Expired Date
                                </th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Stock
                                </th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Harga
                                </th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $product->product_code }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $product->name }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $product->expired_date?->format('d M Y') ?? '-' }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        {{ $product->stock }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-700">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td class="border border-gray-300 px-4 py-3 text-right text-sm whitespace-nowrap">
                                        <a
                                            href="{{ route('products.index', ['view' => $product->id]) }}"
                                            class="inline-flex rounded-md bg-gray-600 px-3 py-1 text-xs font-semibold text-white"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('products.index', ['edit' => $product->id]) }}"
                                            class="ml-2 inline-flex rounded-md bg-yellow-500 px-3 py-1 text-xs font-semibold text-white"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('products.destroy', $product) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
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
                                    <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada data barang.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('products._modal')

</x-app-layout>