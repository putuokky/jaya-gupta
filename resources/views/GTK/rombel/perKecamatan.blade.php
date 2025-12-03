<x-layouts.app :title="__('Data Rombel per Kecamatan')">
    <header class="z-10 py-4 bg-white shadow-md">
        <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
            <h2 class="text-2xl font-semibold text-gray-700">Data Rombel per Kecamatan</h2>
        </div>
    </header>

    <div class="mx-auto px-6 py-6">
        <div class="bg-white rounded shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="space-x-2 flex">
                        <button id="btn-copy" class="bg-gray-300 text-gray-700 px-3 py-2 rounded shadow hover:bg-gray-400">Copy</button>
                        <button id="btn-excel" class="bg-gray-300 text-gray-700 px-3 py-2 rounded shadow hover:bg-gray-400">Excel</button>
                        <button id="btn-csv" class="bg-gray-300 text-gray-700 px-3 py-2 rounded shadow hover:bg-gray-400">CSV</button>
                        <button id="btn-pdf" class="bg-gray-300 text-gray-700 px-3 py-2 rounded shadow hover:bg-gray-400">PDF</button>
                        <button id="btn-print" class="bg-gray-300 text-gray-700 px-3 py-2 rounded shadow hover:bg-gray-400">Print</button>
                    </div>

                    
                </div>

                <div class="flex items-center justify-end mb-4">
                 	<form method="GET" action="" class="flex items-center">
						<label class="mr-2 text-sm text-gray-600">Search:</label>
						<input class="border py-2 px-3 rounded" type="text" value="{{ request('search') }}" name="search" placeholder="Search" aria-label="Search" />
					</form>
                </div>

                <div class="overflow-x-auto">
                    <table id="rombel-table" class="min-w-full divide-y table-auto" style="width:100%">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-sm text-gray-600">
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Sekolah</th>
                                <th class="px-6 py-3">NPSN</th>
                                <th class="px-6 py-3">BP</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Rombongan Belajar</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                          

                            @foreach($data as $i => $row)
                                <tr class="border-t even:bg-white odd:bg-gray-50">
                                    <td class="px-6 py-3 text-sm">{{ (method_exists($data, 'firstItem') ? $data->firstItem() : 1) + $i }}</td>
                                    <td class="px-6 py-3 text-sm text-blue-600">
                                        <a href="{{ URL::to('rombel/perSekolah/' . $row->npsn) }}">
                                        {{ $row->nama}}
                                        </a>
                                    </td>
                                    <td class="px-6 py-3 text-sm">{{ $row->npsn }}</td>
                                    <td class="px-6 py-3 text-sm">{{ $row->bentuk_pendidikan }}</td>
                                    <td class="px-6 py-3 text-sm">{{ $row->status_sekolah }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{$row->rombel_count}}</td>
                                </tr>
                            @endforeach

                            {{-- Totals row --}}
                            <tr class="border-t bg-white font-semibold">
                                <td class="px-6 py-4">&nbsp;</td>
                                <td class="px-6 py-4 text-right">Total</td>
                                <td class="px-6 py-4">&nbsp;</td>
                                <td class="px-6 py-4">&nbsp;</td>
                                <td class="px-6 py-4">&nbsp;</td>
                                <td class="px-6 py-4 text-center">{{ $data->sum('rombongan_belajar') ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

             	<div class="mt-6">
					<div class="flex justify-between items-center text-sm text-gray-600">
						<div>Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? ($data->count() ?? 0) }} entries</div>
						<div>{{ $data->appends(request()->query())->links() ?? '' }}</div>
					</div>
				</div>
            </div>
        </div>
    </div>

    {{-- DataTables and Buttons CDN --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
      
    </script>

</x-layouts.app>
