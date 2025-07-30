<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // ajax datatable

            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                order: [[6, 'desc']], // Mengurutkan berdasarkan kolom Tanggal (kolom ke-7) secara descending
                columns: [
                    { data: 'id', name: 'id', width: '5%'},
                    { data: 'name', name: 'name'},
                    { data: 'phone', name: 'phone'},
                    { data: 'courier', name: 'courier'},
                    { data: 'total_price', name: 'total_price'},
                    { data: 'status', name: 'status'},
                    { 
                        data: 'created_date', 
                        name: 'created_date', 
                        width: '15%',
                        render: function(data, type, row) {
                            return `
                                <div class="text-sm">
                                    <div class="font-medium">${data}</div>
                                    <div class="text-gray-500 text-xs">${row.created_time_ago}</div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '25%',
                        render: function(data, type, row) {
                            var waNumber = row.phone.replace(/^0/, '62'); 
                            var waMessage = `Halo ${row.name}, kami menghubungi terkait pesanan Anda.`;
                            var waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;

                            return `
                                <a href="${waUrl}" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 mr-2">
                                    WhatsApp
                                </a>
                                ${data}
                            `;
                        }

                    }
                ]
            })
        </script>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="shadow overflow-hidden sm-rounded-md mt-6">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Telepone</th>
                                <th>Kurir</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
