<x-app-layout>

<div class="py-8">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="rounded-lg bg-white shadow">

            <div class="flex items-center justify-between border-b px-6 py-5">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Form Transaksi Pembelian
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Tambahkan barang yang dibeli dari supplier.
                    </p>

                </div>

                <a
                    href="{{ route('purchases.index') }}"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100"
                >
                    ← Kembali
                </a>

            </div>

            <form action="{{ route('purchases.store') }}" method="POST">

                @csrf

                @include('purchases._form')

            </form>

        </div>

    </div>

</div>

</x-app-layout>