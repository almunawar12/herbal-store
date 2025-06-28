<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    @php
        // Hanya untuk admin
        $salesMonths = isset($salesChart) ? $salesChart->pluck('month') : [];
        $salesTotals = isset($salesChart) ? $salesChart->pluck('total') : [];
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (Auth::user()->roles === 'ADMIN')
                <!-- Admin View -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="p-4 bg-white rounded shadow">
                        <h3 class="text-gray-600">Total Users</h3>
                        <p class="text-3xl font-bold">{{ $userCount }}</p>
                    </div>
                    <div class="p-4 bg-white rounded shadow">
                        <h3 class="text-gray-600">Total Products</h3>
                        <p class="text-3xl font-bold">{{ $productCount }}</p>
                    </div>
                    <div class="p-4 bg-white rounded shadow">
                        <h3 class="text-gray-600">Total Transaksi</h3>
                        <p class="text-3xl font-bold">{{ $transactionCount }}</p>
                    </div>
                    <div class="p-4 bg-white rounded shadow">
                        <h3 class="text-gray-600">Total Pendapatan</h3>
                        <p class="text-3xl font-bold">Rp {{ number_format($totalTransactionAmount, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Chart -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Grafik Penjualan {{ date('Y') }}</h3>
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            @else
                <!-- User View -->
                <div class="bg-white p-6 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Kamu telah melakukan</p>
                    <p class="text-4xl font-bold text-blue-600 my-2">{{ $userTransactionCount }}</p>
                    <p class="text-gray-600">transaksi.</p>

                    <p class="text-gray-600">Total uang yang kamu keluarkan:</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($userTotalTransactionAmount, 0, ',', '.') }}</p>
                </div>
            @endif
        </div>
    </div>

    @if (Auth::user()->roles === 'ADMIN')
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($salesMonths) !!},
                    datasets: [{
                        label: 'Total Penjualan',
                        data: {!! json_encode($salesTotals) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endif
</x-app-layout>
