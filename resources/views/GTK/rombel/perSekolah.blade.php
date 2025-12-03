<x-layouts.app :title="__('Data Rombongan Belajar per Sekolah')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Rombongan Belajar</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data Rombongan Belajar SD NEGERI 29 DANGIN PURI</h1>
			</div>

			<div class="p-6">
				<div class="flex items-center justify-between mb-4">
					<div class="flex items-center gap-2">
						<button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 flex items-center gap-2">
							<span>+ Tambah</span>
						</button>
					</div>

					<div class="flex items-center gap-4">
						<div class="flex items-center gap-2">
							<label class="text-sm text-gray-600">Show</label>
							<select id="length" class="border px-3 py-2 rounded text-sm">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<label class="text-sm text-gray-600">entries</label>
						</div>

						<form method="GET" action="" class="flex items-center gap-2">
							<label class="text-sm text-gray-600">Search:</label>
							<input class="border py-2 px-3 rounded text-sm" type="text" name="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search" />
						</form>
					</div>
				</div>

				<div class="overflow-x-auto">
					<table id="rombel-sekolah-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th rowspan="2" class="px-4 py-3">No</th>
								<th rowspan="2" class="px-4 py-3">Nama Rombel</th>
								<th rowspan="2" class="px-4 py-3">Tingkat Kelas</th>
								<th colspan="3" class="px-4 py-3 text-center">Jumlah Siswa</th>
								<th rowspan="2" class="px-4 py-3">Wali Kelas</th>
								<th rowspan="2" class="px-4 py-3">Kurikulum</th>
								<th rowspan="2" class="px-4 py-3">Ruangan</th>
							</tr>
							<tr class="text-left text-sm text-gray-600 bg-gray-100">
								<th class="px-4 py-2">L</th>
								<th class="px-4 py-2">P</th>
								<th class="px-4 py-2">Total</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $row)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
										<td class="px-4 py-3 text-sm font-medium">{{ $row->nama_rombel ?? $row['nama_rombel'] ?? $row->nama ?? $row['nama'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->tingkat_kelas ?? $row['tingkat_kelas'] ?? $row->tingkat ?? $row['tingkat'] ?? '' }}</td>
										
										{{-- Jumlah Siswa --}}
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_siswa_l ?? 0 }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_siswa_p ?? 0 }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ ($row->jumlah_siswa_l ?? 0) + ($row->jumlah_siswa_p ?? 0) }}</td>
										
										<td class="px-4 py-3 text-sm">{{ $row->walikelas->nama ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->kurikulum ?? $row['kurikulum'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->ruangan ?? $row['ruangan'] ?? $row->nama_ruangan ?? $row['nama_ruangan'] ?? '' }}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="9">No data available</td>
								</tr>
							@endif
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

	{{-- DataTables scripts --}}
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
