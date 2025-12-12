<x-layouts.app :title="__('Beranda')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Beranda</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<!-- School Header Section -->
		<div class="mb-8">
			<div class="flex items-start gap-8">
				<div class="flex-1">
					<div class="flex items-center gap-3 mb-4">
						<svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
							<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
						</svg>
						<h1 class="text-2xl font-bold text-gray-800">{{ $sekolah->nama }}</h1>
					</div>
					<ul class="space-y-2 text-sm text-gray-600">
						<li>• <strong>NPSN:</strong> {{ $sekolah->npsn }}</li>
						<li>• <strong>Bentuk Pendidikan:</strong> {{ $sekolah->bentuk_pendidikan }}</li>
						<li>• <strong>Status:</strong> {{ $sekolah->status_sekolah }}</li>
						<li>• <strong>Kecamatan:</strong> {{ $sekolah->induk_kecamatan }}</li>
						<li>• <strong>Kabupaten:</strong> {{ $sekolah->induk_kabupaten }}</li>
						<li>• <strong>Provinsi:</strong> {{ $sekolah->induk_provinsi }}</li>
						<li>• <strong>Kepala Sekolah:</strong> {{ $sekolah->kepala_sekolah->nama }}</li>
					</ul>
				</div>

				<!-- jml Cards -->
				<div class="grid grid-cols-2 gap-4">
					<!-- Total GTK -->
					<div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-6 text-white shadow-md">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-sm text-indigo-100">Total GTK</p>
								<p class="text-3xl font-bold">{{ $jml['gtk']  }}</p>
							</div>
							<svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 20 20">
								<path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
							</svg>
						</div>
					</div>

					<!-- Total Peserta Didik -->
					<div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-6 text-white shadow-md">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-sm text-indigo-100">Total Peserta Didik</p>
								<p class="text-3xl font-bold">{{ $jml['pd']  }}</p>
							</div>
							<svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 20 20">
								<path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a4 4 0 00-4-4h-2.5a4 4 0 00-4 4v1h10.5z"/>
							</svg>
						</div>
					</div>

					<!-- Total Rombel -->
					<div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-6 text-white shadow-md">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-sm text-indigo-100">Total Rombel</p>
								<p class="text-3xl font-bold">{{ $jml['rombel']  }}</p>
							</div>
							<svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 20 20">
								<path d="M7 3a1 1 0 000 2h6a1 1 0 000-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v3a2 2 0 01-2 2H6a2 2 0 01-2-2V7zM2 13a1 1 0 011-1h14a1 1 0 011 1v3a2 2 0 01-2 2H4a2 2 0 01-2-2v-3z"/>
							</svg>
						</div>
					</div>

					<!-- Total Ruangan -->
					<div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-6 text-white shadow-md">
						<div class="flex items-center justify-between">
							<div>
								<p class="text-sm text-indigo-100">Total Ruangan</p>
								<p class="text-3xl font-bold">{{ $jml['rombel']  }}</p>
							</div>
							<svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 20 20">
								<path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-12-5h12m-12 8h12m-12 4h12"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Additional jml Cards -->
		<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
			<!-- Total Selaruh Inovasi/Aksi Nyata -->
			<div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-6 text-white shadow-md">
				<svg class="w-10 h-10 mb-3 opacity-20" fill="currentColor" viewBox="0 0 20 20">
					<path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a4 4 0 00-4-4h-2.5a4 4 0 00-4 4v1h10.5z"/>
				</svg>
				<p class="text-sm text-purple-100 mb-1">Total Selaruh Inovasi/Aksi Nyata</p>
				<p class="text-3xl font-bold">{{ $jml['inovasi']  }}</p>
			</div>

			<!-- Total Inovasi/Aksi Nyata Lolos -->
			<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-6 text-white shadow-md">
				<svg class="w-10 h-10 mb-3 opacity-20" fill="currentColor" viewBox="0 0 20 20">
					<path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
				</svg>
				<p class="text-sm text-green-100 mb-1">Total Inovasi/Aksi Nyata Lolos</p>
				<p class="text-3xl font-bold">{{ $jml['inovasi_lulus']  }}</p>
			</div>

			<!-- Total Inovasi/Aksi Nyata Tidak Lolos -->
			<div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-6 text-white shadow-md">
				<svg class="w-10 h-10 mb-3 opacity-20" fill="currentColor" viewBox="0 0 20 20">
					<path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
				</svg>
				<p class="text-sm text-red-100 mb-1">Total Inovasi/Aksi Nyata Tidak Lolos</p>
				<p class="text-3xl font-bold">{{ $jml['inovasi_tolak']  }}</p>
			</div>

			<!-- Menunggu Penilaian -->
			<div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg p-6 text-white shadow-md">
				<svg class="w-10 h-10 mb-3 opacity-20" fill="currentColor" viewBox="0 0 20 20">
					<path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-.707.707a1 1 0 101.414 1.414L9 9.414V6z"/>
				</svg>
				<p class="text-sm text-cyan-100 mb-1">Menunggu Penilaian</p>
				<p class="text-3xl font-bold">{{ $jml['menunggu_penilaian']  }}</p>
			</div>

			<!-- Placeholder -->
			<div></div>
		</div>

		<!-- Data Praktik Baik Section -->
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="bg-gray-50 px-6 py-4 border-b">
				<h2 class="text-lg font-semibold text-gray-800">Data Praktik baik</h2>
			</div>

			<div class="p-6">
				<div class="grid grid-cols-2 gap-4 mb-6">
					<div>
						<label class="block text-sm text-gray-600 mb-2">Bidang Pengembangan</label>
						<select class="w-full border px-3 py-2 rounded text-sm">
							<option>-- Semua --</option>
						</select>
					</div>
					<div></div>
				</div>

				<div class="flex items-center justify-between mb-4">
					<div class="flex items-center gap-2">
						<label class="text-sm text-gray-600">Show</label>
						<select class="border px-3 py-2 rounded text-sm">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						<label class="text-sm text-gray-600">entries</label>
					</div>

					<div class="flex items-center gap-2">
						<label class="text-sm text-gray-600">Search:</label>
						<input class="border py-2 px-3 rounded text-sm" type="text" placeholder="Search" />
					</div>
				</div>

				<div class="overflow-x-auto">
					<table class="min-w-full divide-y">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3">No</th>
								<th class="px-4 py-3">Judul</th>
								<th class="px-4 py-3">Deskripsi</th>
								<th class="px-4 py-3">Penulis</th>
								<th class="px-4 py-3">Bidang Pengembangan</th>
								<th class="px-4 py-3">Waktu Terbit</th>
								<th class="px-4 py-3">Aksi</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							<tr>
								<td class="px-4 py-6 text-center text-gray-500" colspan="7">No data available</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</x-layouts.app>
