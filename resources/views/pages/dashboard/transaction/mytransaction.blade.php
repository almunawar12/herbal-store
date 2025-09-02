<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Transaction
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                order: [[4, 'desc']],
                columns: [
                    // { data: 'name', name: 'name' },
                    { data: 'courier', name: 'courier' },
                    { data: 'total_price', name: 'total_price' },
                    { data: 'status', name: 'status' },
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
                            console.log("Row data:", row);
                            // Ganti nomor admin di bawah ini
                            var adminPhone = '+6281312931133';
                            var product = row.product_name ? row.product_name : '';
                            var waMessage = `Halo Admin, saya ingin konfirmasi transaksi untuk produk: ${product}`;
                            var waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(waMessage)}`;
                            return `
                                <a href="${waUrl}" target="_blank" class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 mr-2">
                                    WhatsApp Admin
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
                                {{-- <th>Nama</th> --}}
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
