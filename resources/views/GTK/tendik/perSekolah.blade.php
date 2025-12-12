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
                                          
                                            <th class="text-center px-3">No</th>
                                            <th class="text-center px-3">Nama</th>
                                            <th class="text-center px-3">NUPTK</th>
                                            <th class="text-center px-3">JK</th>
                                            <th class="text-center px-3">Tempat Lahir</th>
                                            <th class="text-center px-3">Tanggal Lahir</th>
                                            <th class="text-center px-3">NIP</th>
                                            <th class="text-center px-3">Status Kepegawaian</th>
                                            <th class="text-center px-3">Mengajar</th>
                                            <th class="text-center px-3">Gelar Depan</th>
                                            <th class="text-center px-3">Gelar Belakang</th>
                                            <th class="text-center px-3">Jenjang</th>
                                            <th class="text-center px-3">Jurusan/Prodi</th>
                                            <th class="text-center px-3">Sertifikasi</th>
                                            <th class="text-center px-3">Nama Dusun</th>
                                            <th class="text-center px-3">Desa/Kelurahan</th>
                                            <th class="text-center px-3">Kecamatan</th>
                                            <th class="text-center px-3">Kodepos</th>
                                            <th class="text-center px-3">Telepon</th>
                                            <th class="text-center px-3">HP</th>
                                            <th class="text-center px-3">Email</th>
                                            <th class="text-center px-3">Tugas Tambahan</th>
                                            <th class="text-center px-3">SK CPNS</th>
                                            <th class="text-center px-3">Tanggal CPNS</th>
                                            <th class="text-center px-3">SK Pengangkatan</th>
                                            <th class="text-center px-3">TMT Pengangkatan</th>
                                            <th class="text-center px-3">Lembaga Pengangkatan</th>
                                            <th class="text-center px-3">Pangkat Golongan</th>
                                            <th class="text-center px-3">Sumber Gaji</th>
                                            <th class="text-center px-3">Nama Ibu Kandung</th>
                                            <th class="text-center px-3">Status Perkawinan</th>
                                            <th class="text-center px-3">Nama Suami/Istri</th>
                                            <th class="text-center px-3">Pekerjaan Suami/Istri</th>
                                            <th class="text-center px-3">TMT PNS</th>
                                            <th class="text-center px-3">NPWP</th>
                                            <th class="text-center px-3">Bank</th>
                                            <th class="text-center px-3">No Rekening</th>
                                            <th class="text-center px-3">Rekening Atas Nama</th>
                                            <th class="text-center px-3">NIK</th>
                                            <th class="text-center px-3">No KK</th>
                                            <th class="text-center px-3">Guru Penggerak</th>
                                            <th class="text-center px-3">Tugas Tambahan</th>
                                            <th class="text-center px-3">JJM</th>
                                            <th class="text-center px-3">Total JJM</th>
                                            <th class="text-center px-3">Siswa</th>
                                            <th class="text-center px-3">Status Sekolah</th>
                                            @if(Auth::user()->hasRole('kepalasekolah'))
                                        <th class="text-center px-3 sticky right-0 bg-gray-100">Aksi</th>
                                        @endif
                                        </tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $dt)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
							
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nama }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nuptk }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->gender }}</td>
                                                <td class="px-3 whitespace-nowrap" >{{ $dt->tempatlahir }}</td>
                                                <td class="px-3 whitespace-nowrap" >{{Carbon\Carbon::parse($dt->tanggallahir)->format('d-m-Y') }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nip }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->status_kepegawaian }}</td>
                                                <td class="px-3 whitespace-nowrap" >{{ $dt->mengajar }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->gelar_depan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->gelar_belakang }}</td>
                                                <td class="px-3 whitespace-nowrap" >{{ $dt->pendidikan_terakhir }}</td>
                                                <td class="px-3 whitespace-nowrap" >{{ $dt->prodi }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->sertifikasi }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->alamat }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->keldom }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->kecdom }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->kodepos }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->telepon }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->wa }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->email }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->tugas_tambahan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->sk_cpns }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->tgl_cpns }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->sk_pengangkatan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->tmt_pengangkatan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->lembaga_pengangkatan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->golongan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->sumber_gaji }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nm_ibu }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->status_perkawinan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nm_pasangan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->pekerjaan_pasangan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->tmt_pns }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->npwp }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->bank }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->norek_bank }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nama_norek }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nik }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->no_kk }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->is_penggerak }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->jam_tgs_tambahan }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->jjm }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->jam_tgs_tambahan + $dt->jjm }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->siswa }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->status_sekolah }}</td>
                                                @if(Auth::user()->hasRole('kepalasekolah'))
                                                <td class="px-3 text-center sticky right-0 bg-white even:bg-gray-50 z-10">
                                                	<div class="flex items-center justify-center gap-2">
                                                		<a href="/sekolah/tendik/detail/{{$dt->id}}" class="text-blue-600 hover:text-blue-800 px-2 py-1 rounded hover:bg-blue-50" title="Edit">
                                                			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
														</a>
                                                		<button class="text-red-600 hover:text-red-800 px-2 py-1 rounded hover:bg-red-50" title="Delete">
                                                			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                		</button>
                                                	</div>
                                                </td>
												@endif
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
