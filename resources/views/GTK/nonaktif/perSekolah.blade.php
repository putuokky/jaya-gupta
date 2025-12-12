<x-layouts.app :title="__('Data GTK Non Aktif Per Sekolah')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data GTK Non Aktif</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data GTK Non Aktif - Detail Sekolah</h1>
			</div>

			<div class="p-6">
				<div class="flex items-center justify-between mb-4">
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

				<div class="overflow-x-auto">
					<table id="nonaktif-persekolah-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3">No</th>
								<th class="px-4 py-3">Nama</th>
								<th class="px-4 py-3">NUPTK</th>
								<th class="px-4 py-3">JK</th>
								<th class="px-4 py-3">Tempat Lahir</th>
								<th class="px-4 py-3">Tanggal Lahir</th>
								<th class="px-4 py-3">NIP</th>
								<th class="px-4 py-3">Status Kepegawaian</th>
								<th class="px-4 py-3">Mengajar</th>
								<th class="px-4 py-3">Gelar Depan</th>
								<th class="px-4 py-3">Gelar Belakang</th>
								<th class="px-4 py-3">Jenjang</th>
								<th class="px-4 py-3">Jurusan/Prodi</th>
								<th class="px-4 py-3">Sertifikasi</th>
								<th class="px-4 py-3">Nama Dusan</th>
								<th class="px-4 py-3">Desa/Kelurahan</th>
								<th class="px-4 py-3">Kecamatan</th>
								<th class="px-4 py-3">Kodepos</th>
								<th class="px-4 py-3">Telp</th>
								<th class="px-4 py-3">HP</th>
								<th class="px-4 py-3">Email</th>
								<th class="px-4 py-3">Tugas Tambahan</th>
								<th class="px-4 py-3">SK CPNS</th>
								<th class="px-4 py-3">Tanggal SK CPNS</th>
								<th class="px-4 py-3">SK Pengangkatan</th>
								<th class="px-4 py-3">TMT Pengangkatan</th>
								<th class="px-4 py-3">Lembaga Pengangkatan</th>
								<th class="px-4 py-3">Pangkat Gaji</th>
								<th class="px-4 py-3">Sumber Gaji</th>
								<th class="px-4 py-3">Nama Ibu Kandung</th>
								<th class="px-4 py-3">Status Perkawinan</th>
								<th class="px-4 py-3">Nama Suami/Istri</th>
								<th class="px-4 py-3">Pekerjaan Suami/Istri</th>
								<th class="px-4 py-3">TMT PNS</th>
								<th class="px-4 py-3">NPWP</th>
								<th class="px-4 py-3">Bank</th>
								<th class="px-4 py-3">No Rekening</th>
								<th class="px-4 py-3">Rekening Atas Nama</th>
								<th class="px-4 py-3">NIK</th>
								<th class="px-4 py-3">No KK</th>
								<th class="px-4 py-3">Guru Penggerak</th>
								<th class="px-4 py-3">Tugas Tambahan</th>
								<th class="px-4 py-3">JJM</th>
								<th class="px-4 py-3">Total JJM</th>
								<th class="px-4 py-3">Siswa</th>
								<th class="px-4 py-3">Status Sekolah</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@php $no = ($data->currentPage() - 1) * $data->perPage() + 1; @endphp
								@foreach($data as $row)
									<tr class="border-t hover:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ $no++ }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm font-medium">{{ $row->nama_lengkap  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nuptk  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->gender}}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tempatlahir  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tanggallahir  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nip }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->status_kepegawaian }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->mengajar  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->gelar_depan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->gelar_belakang  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->pendidikan_terakhir  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->prodi  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->sertifikasi  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->keldom  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->alamatdom  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->kecdom  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->kodepos }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->wa  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->telepon  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->email  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tugas_tambahan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->sk_cpns  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tgl_cpns  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->sk_pengangkatan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tmt_pengangkatan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->lembaga_pengangkatan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->golongan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->sumber_gaji  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nm_ibu  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->status_perkawinan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nm_pasangan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->pekerjaan_pasangan  }}</td>
										<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->tmt_pns  }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->npwp  }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nama_bank  }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->norek }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nama_norek }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->nik }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->no_kk }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->is_penggerak }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->jam_tgs_tambahan }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->jjm }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->total_jjm }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->siswa }}</td>
									<td class="px-4 py-3 whitespace-nowrap text-sm">{{ $row->status_sekolah }}</td>
								</tr>
								@endforeach
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="47">No data available</td>
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

</x-layouts.app>
