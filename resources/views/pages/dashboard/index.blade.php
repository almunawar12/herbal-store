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
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Total Users -->
    <div class="flex items-center p-4 bg-white rounded shadow">
        <div class="p-3 bg-indigo-100 text-indigo-600 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3h-2M9 20H4v-2a3 3 0 013-3h2m4-4a4 4 0 100-8 4 4 0 000 8zm6 4v-1a3 3 0 00-3-3h-2a3 3 0 00-3 3v1" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600">Total Users</p>
            <p class="text-2xl font-bold">{{ $userCount }}</p>
        </div>
    </div>

    <!-- Total Products -->
    <div class="flex items-center p-4 bg-white rounded shadow">
        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V8a2 2 0 00-2-2h-4V4a2 2 0 00-2-2H8a2 2 0 00-2 2v2H2v11a2 2 0 002 2h3v2a2 2 0 002 2h2a2 2 0 002-2v-2h3a2 2 0 002-2v-1" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600">Total Products</p>
            <p class="text-2xl font-bold">{{ $productCount }}</p>
        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="flex items-center p-4 bg-white rounded shadow">
        <div class="p-3 bg-pink-100 text-pink-600 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2l1 2h13l1-2h2m-1 10h-2a1 1 0 01-1-1v-5H7v5a1 1 0 01-1 1H4a1 1 0 01-1-1v-5H2m1-5l1-2h16l1 2" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600">Total Transaksi</p>
            <p class="text-2xl font-bold">{{ $transactionCount }}</p>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="flex items-center p-4 bg-white rounded shadow">
        <div class="p-3 bg-green-100 text-green-600 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3m6 0a3 3 0 01-3 3m0-6v6m0 4h.01M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600">Total Pendapatan</p>
            <p class="text-2xl font-bold">Rp {{ number_format($totalTransactionAmount, 0, ',', '.') }}</p>
        </div>
    </div>
</div>


                <!-- Chart -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Grafik Penjualan {{ date('Y') }}</h3>
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            @else
                <!-- User View -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Total Transaksi Card -->
                    <div class="flex items-center p-4 bg-white rounded shadow">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600">Jumlah Transaksi</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $userTransactionCount }}</p>
                        </div>
                    </div>
                
                    <!-- Total Pengeluaran Card -->
                    <div class="flex items-center p-4 bg-white rounded shadow">
                        <div class="p-3 bg-green-100 text-green-600 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3m6 0a3 3 0 01-3 3m0-6v6m0 4h.01M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Pengeluaran</p>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($userTotalTransactionAmount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
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
