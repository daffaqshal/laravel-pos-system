<aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white">

    <div class="flex h-16 items-center px-6 border-b border-slate-700">
        <h1 class="text-xl font-bold">
            POS SYSTEM
        </h1>
    </div>

    <nav class="mt-6 px-3">

        <a href="{{ route('dashboard') }}"
           class="flex items-center rounded-lg px-4 py-3 mb-1
           {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">

            Dashboard

        </a>

        <p class="mt-6 mb-2 px-4 text-xs uppercase tracking-wider text-gray-500">
            Master
        </p>

        <a href="{{ route('suppliers.index') }}"
           class="flex items-center rounded-lg px-4 py-3 mb-1
           {{ request()->routeIs('suppliers.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">

            Supplier

        </a>

        <a href="{{ route('products.index') }}"
           class="flex items-center rounded-lg px-4 py-3 mb-1
           {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">

            Barang

        </a>

        <p class="mt-6 mb-2 px-4 text-xs uppercase tracking-wider text-gray-500">
            Transaksi
        </p>

        <a href="{{ route('purchases.index') }}"
           class="flex items-center rounded-lg px-4 py-3 mb-1
           {{ request()->routeIs('purchases.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">

            Pembelian

        </a>

        <a href="{{ route('sales.index') }}"
           class="flex items-center rounded-lg px-4 py-3 mb-1
           {{ request()->routeIs('sales.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">

            Penjualan

        </a>

    </nav>

</aside>