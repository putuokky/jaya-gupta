<x-layouts.app :title="__('Data Guru per Sekolah')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Guru</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data Guru {{ $title ?? '...' }}</h1>
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
					<table id="guru-sekolah-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							 <tr>
                                          
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">NUPTK</th>
                                            <th class="text-center">JK</th>
                                            <th class="text-center">Tempat Lahir</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Status Kepegawaian</th>
                                            <th class="text-center">Mengajar</th>
                                            <th class="text-center">Gelar Depan</th>
                                            <th class="text-center">Gelar Belakang</th>
                                            <th class="text-center">Jenjang</th>
                                            <th class="text-center">Jurusan/Prodi</th>
                                            <th class="text-center">Sertifikasi</th>
                                            <th class="text-center">Nama Dusun</th>
                                            <th class="text-center">Desa/Kelurahan</th>
                                            <th class="text-center">Kecamatan</th>
                                            <th class="text-center">Kodepos</th>
                                            <th class="text-center">Telepon</th>
                                            <th class="text-center">HP</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Tugas Tambahan</th>
                                            <th class="text-center">SK CPNS</th>
                                            <th class="text-center">Tanggal CPNS</th>
                                            <th class="text-center">SK Pengangkatan</th>
                                            <th class="text-center">TMT Pengangkatan</th>
                                            <th class="text-center">Lembaga Pengangkatan</th>
                                            <th class="text-center">Pangkat Golongan</th>
                                            <th class="text-center">Sumber Gaji</th>
                                            <th class="text-center">Nama Ibu Kandung</th>
                                            <th class="text-center">Status Perkawinan</th>
                                            <th class="text-center">Nama Suami/Istri</th>
                                            <th class="text-center">Pekerjaan Suami/Istri</th>
                                            <th class="text-center">TMT PNS</th>
                                            <th class="text-center">NPWP</th>
                                            <th class="text-center">Bank</th>
                                            <th class="text-center">No Rekening</th>
                                            <th class="text-center">Rekening Atas Nama</th>
                                            <th class="text-center">NIK</th>
                                            <th class="text-center">No KK</th>
                                            <th class="text-center">Guru Penggerak</th>
                                            <th class="text-center">Tugas Tambahan</th>
                                            <th class="text-center">JJM</th>
                                            <th class="text-center">Total JJM</th>
                                            <th class="text-center">Siswa</th>
                                            <th class="text-center">Status Sekolah</th>
                                        </tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $dt)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
							
                                                <td class="whitespace-nowrap">{{ $dt->nama }}</td>
                                                <td>{{ $dt->nuptk }}</td>
                                                <td>{{ $dt->gender }}</td>
                                                <td  class="whitespace-nowrap">{{ $dt->tempatlahir }}</td>
                                                <td  class="whitespace-nowrap">{{Carbon\Carbon::parse($dt->tanggallahir)->format('d-m-Y') }}</td>
                                                <td>{{ $dt->nip }}</td>
                                                <td>{{ $dt->status_kepegawaian }}</td>
                                                <td  class="whitespace-nowrap">{{ $dt->mengajar }}</td>
                                                <td>{{ $dt->gelar_depan }}</td>
                                                <td>{{ $dt->gelar_belakang }}</td>
                                                <td  class="whitespace-nowrap">{{ $dt->pendidikan_terakhir }}</td>
                                                <td  class="whitespace-nowrap">{{ $dt->prodi }}</td>
                                                <td>{{ $dt->sertifikasi }}</td>
                                                <td>{{ $dt->alamat }}</td>
                                                <td>{{ $dt->keldom }}</td>
                                                <td>{{ $dt->kecdom }}</td>
                                                <td>{{ $dt->kodepos }}</td>
                                                <td>{{ $dt->telepon }}</td>
                                                <td>{{ $dt->wa }}</td>
                                                <td>{{ $dt->email }}</td>
                                                <td>{{ $dt->tugas_tambahan }}</td>
                                                <td>{{ $dt->sk_cpns }}</td>
                                                <td>{{ $dt->tgl_cpns }}</td>
                                                <td>{{ $dt->sk_pengangkatan }}</td>
                                                <td>{{ $dt->tmt_pengangkatan }}</td>
                                                <td>{{ $dt->lembaga_pengangkatan }}</td>
                                                <td>{{ $dt->golongan }}</td>
                                                <td>{{ $dt->sumber_gaji }}</td>
                                                <td>{{ $dt->nm_ibu }}</td>
                                                <td>{{ $dt->status_perkawinan }}</td>
                                                <td>{{ $dt->nm_pasangan }}</td>
                                                <td>{{ $dt->pekerjaan_pasangan }}</td>
                                                <td>{{ $dt->tmt_pns }}</td>
                                                <td>{{ $dt->npwp }}</td>
                                                <td>{{ $dt->bank }}</td>
                                                <td>{{ $dt->norek_bank }}</td>
                                                <td>{{ $dt->nama_norek }}</td>
                                                <td>{{ $dt->nik }}</td>
                                                <td>{{ $dt->no_kk }}</td>
                                                <td>{{ $dt->is_penggerak }}</td>
                                                <td>{{ $dt->jam_tgs_tambahan }}</td>
                                                <td>{{ $dt->jjm }}</td>
                                                <td>{{ $dt->jam_tgs_tambahan + $dt->jjm }}</td>
                                                <td>{{ $dt->siswa }}</td>
                                                <td>{{ $dt->status_sekolah }}</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td class="px-4 py-6 text-center text-gray-500" colspan="29">No data available</td>
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
