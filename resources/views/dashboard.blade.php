<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>


    <div class="py-8">
        

        <div class="mx-auto max-w-7xl px-4">
            

            <div class="rounded-lg bg-white p-6 shadow">

                <h3 class="mb-5 text-xl font-bold">
                    Grafik Penjualan
                </h3>
            <a
                href="{{ route('dashboard.exportExcel') }}"
                class="rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700"
            >
                Download Laporan Excel
            </a>
                <canvas id="salesChart" height="100"></canvas>

            </div>
            

        </div>

    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = @json($labels);

const totals = @json($totals);

new Chart(document.getElementById('salesChart'), {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [{

            label: 'Penjualan',

            data: totals,

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>