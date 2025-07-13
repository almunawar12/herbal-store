<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                let table = $('#reportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("dashboard.reports.index") }}',
                        data: function (d) {
                            d.start_date = $('#start_date').val();
                            d.end_date = $('#end_date').val();
                        }
                    },
                    columns: [
                        { data: 'code', name: 'code' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'total_price', name: 'total_price' },
                        { data: 'created_at', name: 'created_at' },
                    ]
                });

                $('#filter').click(function () {
                    table.ajax.reload();
                });

                $('#export-pdf').click(function () {
                    const start = $('#start_date').val();
                    const end = $('#end_date').val();
                    const url = `{{ route('dashboard.reports.export-pdf') }}?start_date=${start}&end_date=${end}`;
                    window.open(url, '_blank');
                });
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filter & Export -->
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4 items-end sm:items-center sm:justify-between">
                    <div class="flex gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                            <input type="date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                            <input type="date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" />
                        </div>
                        <div class="flex items-end">
                            <button id="filter" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 mt-1">
                                Filter
                            </button>
                        </div>
                    </div>
                    <div>
                        <button id="export-pdf" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700">
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table id="reportTable" class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
