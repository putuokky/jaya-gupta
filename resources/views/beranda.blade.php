
<x-layouts.app :title="__('Beranda')">

	<div class="flex flex-col flex-1 w-full">
		<header class="z-10 py-4 bg-white shadow-md">
			<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
				<h2 class="text-2xl font-semibold text-gray-700">Beranda</h2>
			</div>
		</header>

		<main class="h-full pb-16 mt-5 overflow-y-auto">
			<div class="w-full mx-auto grid">
				<!-- Metric cards (3 rows x 4 columns) -->
				<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
					@php
						$metrics = [
							['icon'=>'M19 11H5...','label'=>'Total Sekolah','value'=>782,'color'=>'blue'],
							['icon'=>'M13 7...','label'=>'Total PNS','value'=>27,'color'=>'indigo'],
							['icon'=>'M10 2...','label'=>'Jumlah Pengawas','value'=>'NaN','color'=>'purple'],
							['icon'=>'M3 1...','label'=>'Jumlah Peserta Didik','value'=>55791,'color'=>'indigo'],
							['icon'=>'M13 6...','label'=>'Jumlah GTK','value'=>47,'color'=>'blue'],
							['icon'=>'M4 4...','label'=>'Jumlah PPPK','value'=>0,'color'=>'blue'],
							['icon'=>'M14 5...','label'=>'Jumlah Guru Penggerak','value'=>47,'color'=>'blue'],
							['icon'=>'M3 1...','label'=>'Jumlah Ruangan','value'=>1273,'color'=>'blue'],
							['icon'=>'M3 1...','label'=>'Total Seluruh Inovasi/Aksi Nyata','value'=>157,'color'=>'purple'],
							['icon'=>'M3 1...','label'=>'Total Inovasi/Aksi Nyata Lolos','value'=>30,'color'=>'green'],
							['icon'=>'M3 1...','label'=>'Total Inovasi/Aksi Nyata Tidak Lolos','value'=>5,'color'=>'red'],
							['icon'=>'M3 1...','label'=>'Menunggu Penilaian','value'=>122,'color'=>'cyan'],
						];
					@endphp

					@foreach($metrics as $m)
						<div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
							<div class="p-3 mr-4 text-{{ $m['color'] }}-500 bg-{{ $m['color'] }}-100 rounded-full">
								<!-- placeholder icon -->
								<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3h12v14H4z" /></svg>
							</div>
							<div>
								<p class="mb-2 text-sm font-medium text-gray-600">{{ $m['label'] }}</p>
								<p class="text-lg font-semibold text-gray-700">{{ $m['value'] }}</p>
							</div>
						</div>
					@endforeach
				</div>

				<!-- Data Praktik baik section -->
				<h4 class="mb-4 text-lg font-semibold text-gray-600">Data Praktik baik</h4>
				<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4">
						<div>
							<label class="block text-sm text-gray-600 mb-2">Bidang Pengembangan</label>
							<select class="block w-64 px-3 py-2 border rounded text-sm">
								<option>-- Semua --</option>
							</select>
						</div>
						<div class="flex items-center justify-end">
							<label class="mr-2 text-sm text-gray-600">Search:</label>
							<input id="global-search" class="px-3 py-2 border rounded text-sm" type="text">
						</div>
					</div>

					<div class="w-full overflow-hidden rounded-lg">
						<div class="w-full overflow-x-auto">
							<table class="w-full whitespace-no-wrap" id="practices-table">
								<thead>
									<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
										<th class="px-4 py-3">No</th>
										<th class="px-4 py-3">Judul</th>
										<th class="px-4 py-3">Deskripsi</th>
										<th class="px-4 py-3">Penulis</th>
										<th class="px-4 py-3">Bidang Pengembangan</th>
										<th class="px-4 py-3">Waktu Terbit</th>
										<th class="px-4 py-3">Aksi</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y">
									@for($i=1;$i<=10;$i++)
										<tr class="text-gray-700">
											<td class="px-4 py-3">{{ $i }}</td>
											<td class="px-4 py-3 text-sm">TEKNOlogi DALAM PENGAJARAN DAN PEMBELAJARAN BERUPA GOOGLE SITES</td>
											<td class="px-4 py-3 text-sm">Link Media Pembelajaran :https://sites.google.com/view/phytagoras-theorem/homeMultimedia adalah integrasi dari beberapa komponen media ...</td>
											<td class="px-4 py-3 text-sm">Ni Ketut Yulianti S.Pd.</td>
											<td class="px-4 py-3 text-sm">Media Pembelajaran</td>
											<td class="px-4 py-3 text-sm">2024-08-27 12:46</td>
											<td class="px-4 py-3 text-sm">
												<button class="px-3 py-1 text-white bg-blue-500 rounded">Lihat</button>
											</td>
										</tr>
									@endfor
								</tbody>
							</table>
						</div>
						<div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
							<span class="flex items-center col-span-3">Showing 1-10 of 782</span>
							<span class="col-span-2"></span>
							<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
								<nav aria-label="Table navigation">
									<ul class="inline-flex items-center">
										<li><button class="px-3 py-1 rounded-md">Prev</button></li>
										<li><button class="px-3 py-1">1</button></li>
										<li><button class="px-3 py-1 text-white bg-purple-600 rounded-md">2</button></li>
										<li><button class="px-3 py-1">Next</button></li>
									</ul>
								</nav>
							</span>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	{{-- DataTables minimal init for search/filtering (keeps Windmill styles) --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var table = $('#practices-table').DataTable({
				paging: true,
				pageLength: 10,
				ordering: false,
				info: false,
				dom: 'rtp'
			});

			$('#global-search').on('keyup', function () {
				table.search(this.value).draw();
			});
		});
	</script>

</x-layouts.app>
