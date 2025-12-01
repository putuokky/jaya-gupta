<x-layouts.app :title="__('Data Peserta Didik per Sekolah')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Peserta Didik</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data Peserta Didik di {{ $title ?? '...' }}</h1>
			</div>

			<div class="p-6">
				<div class="flex items-center justify-between mb-4">
					<div class="space-x-2 flex">
						<button id="btn-copy" class="bg-gray-200 text-gray-800 px-3 py-2 rounded shadow">Copy</button>
						<button id="btn-excel" class="bg-gray-200 text-gray-800 px-3 py-2 rounded shadow">Excel</button>
						<button id="btn-csv" class="bg-gray-200 text-gray-800 px-3 py-2 rounded shadow">CSV</button>
						<button id="btn-pdf" class="bg-gray-200 text-gray-800 px-3 py-2 rounded shadow">PDF</button>
						<button id="btn-print" class="bg-gray-200 text-gray-800 px-3 py-2 rounded shadow">Print</button>
					</div>

					<form method="GET" action="" class="flex items-center">
						<label class="mr-2 text-sm text-gray-600">Search:</label>
						<input class="border py-2 px-3 rounded" type="text" name="search" placeholder="Search" aria-label="Search" />
					</form>
				</div>

				<div class="overflow-x-auto">
					<table id="per-sekolah-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th rowspan="2" class="px-4 py-3">No</th>
								<th rowspan="2" class="px-4 py-3">Nama Siswa</th>
								<th rowspan="2" class="px-4 py-3">NIPD</th>
								<th rowspan="2" class="px-4 py-3">JK</th>
								<th rowspan="2" class="px-4 py-3">NISN</th>
								<th rowspan="2" class="px-4 py-3">Tempat Lahir</th>
								<th rowspan="2" class="px-4 py-3">Tanggal Lahir</th>
								<th rowspan="2" class="px-4 py-3">NIK</th>
								<th rowspan="2" class="px-4 py-3">Agama</th>
								<th rowspan="2" class="px-4 py-3">Alamat</th>
								<th rowspan="2" class="px-4 py-3">HP</th>
								<th colspan="3" class="px-4 py-3 text-center">Data Ayah</th>
								<th colspan="3" class="px-4 py-3 text-center">Data Ibu</th>
								<th colspan="3" class="px-4 py-3 text-center">Data Wali</th>

								<!-- additional columns appended at the end (rowspan=2) -->
								<th rowspan="2" class="px-4 py-3">Rombel Saat Ini</th>
								<th rowspan="2" class="px-4 py-3">Kebutuhan Khusus</th>
								<th rowspan="2" class="px-4 py-3">Sekolah Asal</th>
								<th rowspan="2" class="px-4 py-3">Anak ke-berapa</th>
								<th rowspan="2" class="px-4 py-3">No KK</th>
								<th rowspan="2" class="px-4 py-3">Berat Badan</th>
								<th rowspan="2" class="px-4 py-3">Tinggi Badan</th>
								<th rowspan="2" class="px-4 py-3">Lingkar Kepala</th>
								<th rowspan="2" class="px-4 py-3">Jml. Saudara Kandung</th>
								<th rowspan="2" class="px-4 py-3">Jarak Rumah ke Sekolah (KM)</th>
							</tr>
							<tr class="text-left text-sm text-gray-600 bg-gray-100">
								<th class="px-4 py-2">Nama</th>
								<th class="px-4 py-2">Jenjang Pendidikan</th>
								<th class="px-4 py-2">Pekerjaan</th>

								<th class="px-4 py-2">Nama</th>
								<th class="px-4 py-2">Jenjang Pendidikan</th>
								<th class="px-4 py-2">Pekerjaan</th>

								<th class="px-4 py-2">Nama</th>
								<th class="px-4 py-2">Jenjang Pendidikan</th>
								<th class="px-4 py-2">Pekerjaan</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $row)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->nama}}</td>
										<td class="px-4 py-3 text-sm">{{ $row->nipd ?? $row['nipd'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->jk ?? $row['jk'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->nisn ?? $row['nisn'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->tempatlahir  }}</td>
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($row->tgllahir)->format('d-m-Y') }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->nik ?? $row['nik'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->agama ?? $row['agama'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->alamat ?? $row['alamat'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->hp ?? $row['hp'] ?? '' }}</td>

										{{-- Data Ayah --}}
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->nama_ayah ?? $row['nama_ayah'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pendidikan_ayah ?? $row['pendidikan_ayah'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pekerjaan_ayah ?? $row['pekerjaan_ayah'] ?? '' }}</td>

										{{-- Data Ibu --}}
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->nama_ibu ?? $row['nama_ibu'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pendidikan_ibu ?? $row['pendidikan_ibu'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pekerjaan_ibu ?? $row['pekerjaan_ibu'] ?? '' }}</td>

										{{-- Data Wali --}}
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->nama_wali ?? $row['nama_wali'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pendidikan_wali ?? $row['pendidikan_wali'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->pekerjaan_wali ?? $row['pekerjaan_wali'] ?? '' }}</td>

										{{-- Additional appended columns --}}
										<td class="px-4 py-3 text-sm">{{ $row->rombel_saat_ini ?? $row['rombel_saat_ini'] ?? $row->rombel ?? $row['rombel'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->kebutuhan_khusus ?? $row['kebutuhan_khusus'] ?? $row->kebutuhan_khusus_id ?? $row['kebutuhan_khusus_id'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm whitespace-nowrap">{{ $row->sekolah_asal ?? $row['sekolah_asal'] ?? $row->asal_sekolah ?? $row['asal_sekolah'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->anak_ke ?? $row['anak_ke'] ?? $row->anak_keberapa ?? $row['anak_keberapa'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->no_kk ?? $row['no_kk'] ?? $row->no_kk_peserta ?? $row['no_kk_peserta'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->berat_badan ?? $row['berat_badan'] ?? $row->bb ?? $row['bb'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->tinggi_badan ?? $row['tinggi_badan'] ?? $row->tb ?? $row['tb'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->lingkar_kepala ?? $row['lingkar_kepala'] ?? $row->lingkar_kepala_cm ?? $row['lingkar_kepala_cm'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->jml_saudara  }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->jarak_sekolah }}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="30">No data available</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

				<div class="mt-6">
					<div class="flex justify-between items-center text-sm text-gray-600">
						<div>Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? ($data->count() ?? 0) }} entries</div>
						<div>{{ $data->links() ?? '' }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- DataTables scripts (only this file) --}}
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
		document.addEventListener('DOMContentLoaded', function () {
	
			// wire top-left static buttons to datatables buttons
			var dtButtons = table.buttons();
			$('#btn-copy').on('click', function(){ dtButtons.trigger('buttons-action', { action: 'copyHtml5' }); });
			$('#btn-excel').on('click', function(){ dtButtons.trigger('buttons-action', { action: 'excelHtml5' }); });
			$('#btn-csv').on('click', function(){ dtButtons.trigger('buttons-action', { action: 'csvHtml5' }); });
			$('#btn-pdf').on('click', function(){ dtButtons.trigger('buttons-action', { action: 'pdfHtml5' }); });
			$('#btn-print').on('click', function(){ dtButtons.trigger('buttons-action', { action: 'print' }); });
		});
	</script>

</x-layouts.app>

