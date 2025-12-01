<x-layouts.app :title="__('Dashboard')">

	<div class=" mx-auto px-4">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-600 p-6">
				<h1 class="text-2xl text-white font-semibold">Data Sekolah di Kec. Denpasar Barat</h1>
				
			</div>

			<div class="p-6">
				<div class="bg-blue-100 border-l-4 border-blue-400 text-blue-700 p-4 rounded mb-6">
					<p>Data Sekolah bersumber dari <code class="bg-white px-1 py-0.5 rounded text-sm">dapo.kemdikbud.go.id</code></p>
				</div>

				<div class="flex items-center justify-end mb-4">
					<div class="space-x-2">
						<button id="btn-pull" class="bg-purple-600 text-white px-4 py-2 rounded shadow">Tarik data dapo ke database</button>
					</div>
				
				</div>
                	<form action="" class="flex items-center justify-between mb-4">
                        <div class="space-x-2 flex ">
						<button class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">Copy</button>
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">CSV</button>
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">Excel</button>
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">PDF</button>
                        <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">Print</button>
					</div>
					<div class="space-x-2">
						   <input
                  class="border py-2 px-3 rounded"
                  type="text"
                  name="search"
                  placeholder="Search"
                  aria-label="Search"
                />
                <button type="submit" class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow">Search</button>
					</div>
                    </form>

				<div class="overflow-x-auto">
					<table id="schools-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3">No</th>
								<th class="px-4 py-3">Nama Sekolah</th>
								<th class="px-4 py-3">NPSN</th>
								<th class="px-4 py-3">BP</th>
								<th class="px-4 py-3">Status</th>
								<th class="px-4 py-3">Guru</th>
								<th class="px-4 py-3">Pegawai</th>
							</tr>
						</thead>
						<tbody class="bg-white">
						

							@foreach($data as $i => $r)
								<tr class="border-t">
									<td class="px-4 py-3 text-sm">{{ $data->firstItem() + $i }}</td>
                                    	  @php
                                                        $npsn = trim($r->npsn);
                                                        $npsn = Crypt::encrypt($npsn);
                                                    @endphp
									<td class="px-4 py-3 text-sm text-indigo-600"><a href="/data-sekolah/show-detail/{{ $npsn }}">{{ $r->nama }}</a></td>
									<td class="px-4 py-3 text-sm">{{ $r->npsn }}</td>
									<td class="px-4 py-3 text-sm">{{ $r->bentuk_pendidikan }}</td>
									<td class="px-4 py-3 text-sm">{{ $r->status_sekolah }}</td>
									<td class="px-4 py-3 text-sm text-center">{{ $r->guru_spatie_count }}</td>
									<td class="px-4 py-3 text-sm text-center">{{ $r->tendik_spatie_count }}</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot class="bg-gray-50">
							<tr>
								<td colspan="5" class="px-4 py-3 text-right font-semibold">Total</td>
								<td class="px-4 py-3 text-center font-semibold">741</td>
								<td class="px-4 py-3 text-center font-semibold">237</td>
							</tr>
						</tfoot>
					</table>
                                                         <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center">
                      
                                  {{$data->links()}}
                    </div>
                </div></div>
				</div>
			</div>
		</div>
	</div>

	{{-- DataTables & Buttons CDN (jQuery required) --}}
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

	

</x-layouts.app>
