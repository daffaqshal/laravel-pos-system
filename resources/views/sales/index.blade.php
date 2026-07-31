<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Penjualan
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4">

            @if(session('success'))

                <div class="mb-5 rounded-lg border border-green-300 bg-green-100 p-4 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            <div class="rounded-lg bg-white shadow">

                <div class="flex items-center justify-between border-b p-6">

                    <div>

                        <h3 class="text-xl font-bold text-gray-800">
                            Daftar Penjualan
                        </h3>

                        <p class="text-sm text-gray-500">
                            Riwayat transaksi penjualan barang.
                        </p>

                    </div>

                    <a
                        href="{{ route('sales.create') }}"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 font-semibold text-white hover:bg-blue-700"
                    >
                        + Tambah Penjualan
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full border-collapse">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-3 text-center w-16">
                                    No
                                </th>

                                <th class="border px-4 py-3">
                                    No Penjualan
                                </th>

                                <th class="border px-4 py-3">
                                    Tanggal
                                </th>

                                <th class="border px-4 py-3">
                                    Barang
                                </th>

                                <th class="border px-4 py-3 text-center">
                                    Qty
                                </th>

                                <th class="border px-4 py-3 text-right">
                                    Grand Total
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($sales as $sale)

                                @php
                                    $item = $sale->items->first();
                                @endphp

                                <tr class="hover:bg-gray-50">

                                    <td class="border px-4 py-3 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3 font-medium">
                                        {{ $sale->sale_number }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}
                                    </td>

                                    <td class="border px-4 py-3">
                                        {{ $item?->product?->name ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-center">
                                        {{ $item?->qty ?? 0 }}
                                    </td>

                                    <td class="border px-4 py-3 text-right font-semibold">
                                        Rp {{ number_format($sale->grand_total,0,',','.') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="border py-8 text-center text-gray-500"
                                    >
                                        Belum ada transaksi penjualan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="border-t p-5">

                    {{ $sales->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>