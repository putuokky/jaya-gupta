<x-layouts.app :title="__('Data Guru per Sekolah')" x-data="guruData()">
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
					<thead class="bg-gray-100 sticky top-0 z-10">
							 <tr>
                                          
                                            <th class="text-center px-2">No</th>
                                            <th class="text-center px-2">Nama</th>
                                            <th class="text-center px-2">NUPTK</th>
                                            <th class="text-center px-2">JK</th>
                                            <th class="text-center px-2">Tempat Lahir</th>
                                            <th class="text-center px-2">Tanggal Lahir</th>
                                            <th class="text-center px-2">NIP</th>
                                            <th class="text-center px-2">Status Kepegawaian</th>
                                            <th class="text-center px-2">Mengajar</th>
                                            <th class="text-center px-2">Gelar Depan</th>
                                            <th class="text-center px-2">Gelar Belakang</th>
                                            <th class="text-center px-2">Jenjang</th>
                                            <th class="text-center px-2">Jurusan/Prodi</th>
                                            <th class="text-center px-2">Sertifikasi</th>
                                            <th class="text-center px-2">Nama Dusun</th>
                                            <th class="text-center px-2">Desa/Kelurahan</th>
                                            <th class="text-center px-2">Kecamatan</th>
                                            <th class="text-center px-2">Kodepos</th>
                                            <th class="text-center px-2">Telepon</th>
                                            <th class="text-center px-2">HP</th>
                                            <th class="text-center px-2">Email</th>
                                            <th class="text-center px-2">Tugas Tambahan</th>
                                            <th class="text-center px-2">SK CPNS</th>
                                            <th class="text-center px-2">Tanggal CPNS</th>
                                            <th class="text-center px-2">SK Pengangkatan</th>
                                            <th class="text-center px-2">TMT Pengangkatan</th>
                                            <th class="text-center px-2">Lembaga Pengangkatan</th>
                                            <th class="text-center px-2">Pangkat Golongan</th>
                                            <th class="text-center px-2">Sumber Gaji</th>
                                            <th class="text-center px-2">Nama Ibu Kandung</th>
                                            <th class="text-center px-2">Status Perkawinan</th>
                                            <th class="text-center px-2">Nama Suami/Istri</th>
                                            <th class="text-center px-2">Pekerjaan Suami/Istri</th>
                                            <th class="text-center px-2">TMT PNS</th>
                                            <th class="text-center px-2">NPWP</th>
                                            <th class="text-center px-2">Bank</th>
                                            <th class="text-center px-2">No Rekening</th>
                                            <th class="text-center px-2">Rekening Atas Nama</th>
                                            <th class="text-center px-2">NIK</th>
                                            <th class="text-center px-2">No KK</th>
                                            <th class="text-center px-2">Guru Penggerak</th>
                                            <th class="text-center px-2">Tugas Tambahan</th>
                                            <th class="text-center px-2">JJM</th>
                                            <th class="text-center px-2">Total JJM</th>
                                            <th class="text-center px-2">Siswa</th>
                                            <th class="text-center px-2">Status Sekolah</th>
											@if(Auth::user()->hasRole('kepalasekolah'))
                                            <th class="text-center px-2 sticky right-0 bg-gray-100 z-20">Aksi</th>
											@endif
                                        </tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $dt)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
							
                                                <td class="px-3 whitespace-nowrap" >{{ $dt->nama }}</td>
                                                <td class="px-3">{{ $dt->nuptk }}</td>
                                                <td class="px-3" align="center">{{ $dt->gender }}</td>
                                                <td class="px-3 whitespace-nowrap"  >{{ $dt->tempatlahir }}</td>
                                                <td class="px-3 whitespace-nowrap"  >{{Carbon\Carbon::parse($dt->tanggallahir)->format('d-m-Y') }}</td>
                                                <td class="px-3">{{ $dt->nip }}</td>
                                                <td class="px-3">{{ $dt->status_kepegawaian }}</td>
                                                <td class="px-3 whitespace-nowrap"  >{{ $dt->mengajar }}</td>
                                                <td class="px-3">{{ $dt->gelar_depan }}</td>
                                                <td class="px-3">{{ $dt->gelar_belakang }}</td>
                                                <td class="px-3 whitespace-nowrap"  >{{ $dt->pendidikan_terakhir }}</td>
                                                <td class="px-3 whitespace-nowrap"  >{{ $dt->prodi }}</td>
                                                <td class="px-3">{{ $dt->sertifikasi }}</td>
                                                <td class="px-3">{{ $dt->alamat }}</td>
                                                <td class="px-3">{{ $dt->keldom }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->kecdom }}</td>
                                                <td class="px-3">{{ $dt->kodepos }}</td>
                                                <td class="px-3">{{ $dt->telepon }}</td>
                                                <td class="px-3">{{ $dt->wa }}</td>
                                                <td class="px-3">{{ $dt->email }}</td>
                                                <td class="px-3">{{ $dt->tugas_tambahan }}</td>
                                                <td class="px-3">{{ $dt->sk_cpns }}</td>
                                                <td class="px-3">{{ $dt->tgl_cpns }}</td>
                                                <td class="px-3">{{ $dt->sk_pengangkatan }}</td>
                                                <td class="px-3">{{ $dt->tmt_pengangkatan }}</td>
                                                <td class="px-3">{{ $dt->lembaga_pengangkatan }}</td>
                                                <td class="px-3">{{ $dt->golongan }}</td>
                                                <td class="px-3">{{ $dt->sumber_gaji }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nm_ibu }}</td>
                                                <td class="px-3">{{ $dt->status_perkawinan }}</td>
                                                <td class="px-3">{{ $dt->nm_pasangan }}</td>
                                                <td class="px-3">{{ $dt->pekerjaan_pasangan }}</td>
                                                <td class="px-3">{{ $dt->tmt_pns }}</td>
                                                <td class="px-3">{{ $dt->npwp }}</td>
                                                <td class="px-3">{{ $dt->bank }}</td>
                                                <td class="px-3">{{ $dt->norek_bank }}</td>
                                                <td class="px-3 whitespace-nowrap">{{ $dt->nama_norek }}</td>
                                                <td class="px-3">{{ $dt->nik }}</td>
                                                <td class="px-3">{{ $dt->no_kk }}</td>
                                                <td class="px-3">{{ $dt->is_penggerak }}</td>
                                                <td class="px-3">{{ $dt->jam_tgs_tambahan }}</td>
                                                <td class="px-3">{{ $dt->jjm }}</td>
                                                <td class="px-3">{{ $dt->jam_tgs_tambahan + $dt->jjm }}</td>
                                                <td class="px-3">{{ $dt->siswa }}</td>
                                                <td class="px-3">{{ $dt->status_sekolah }}</td>
												@if(Auth::user()->hasRole('kepalasekolah'))
                                                <td class="px-3 text-center sticky right-0 bg-white even:bg-gray-50 z-10">
                                                	<div class="flex items-center justify-center gap-2">
                                                		<a href="/sekolah/guru/detail/{{$dt->id}}" class="text-blue-600 hover:text-blue-800 px-2 py-1 rounded hover:bg-blue-50" title="Edit">
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

	<!-- Edit Modal -->
	<div x-show="editModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click.self="editModalOpen = false" style="display: none;">
		<div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
			<!-- Modal Header -->
			<div class="sticky top-0 bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4 border-b flex items-center justify-between">
				<h2 class="text-xl font-semibold text-white">Edit Data Guru</h2>
				<button @click="closeEditModal()" class="text-white hover:bg-indigo-800 rounded-full p-1">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
				</button>
			</div>

			<!-- Modal Body -->
			<form class="p-6 space-y-4" @submit.prevent="saveChanges()">
				<!-- Nama -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
						<input type="text" x-model="selectedData.nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">NUPTK</label>
						<input type="text" x-model="selectedData.nuptk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Gender & Tempat Lahir -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
						<input type="text" x-model="selectedData.gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
						<input type="text" x-model="selectedData.tempatlahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Tanggal Lahir & NIP -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
						<input type="date" x-model="selectedData.tanggallahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
						<input type="text" x-model="selectedData.nip" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Status Kepegawaian & Mengajar -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Status Kepegawaian</label>
						<input type="text" x-model="selectedData.status_kepegawaian" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Mengajar</label>
						<input type="text" x-model="selectedData.mengajar" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Gelar Depan & Belakang -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
						<input type="text" x-model="selectedData.gelar_depan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
						<input type="text" x-model="selectedData.gelar_belakang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Pendidikan Terakhir & Prodi -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Terakhir</label>
						<input type="text" x-model="selectedData.pendidikan_terakhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Jurusan/Prodi</label>
						<input type="text" x-model="selectedData.prodi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- Email & Telepon -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
						<input type="email" x-model="selectedData.email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
						<input type="text" x-model="selectedData.telepon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
					</div>
				</div>

				<!-- WhatsApp -->
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
					<input type="text" x-model="selectedData.wa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
				</div>

				<!-- Modal Footer -->
				<div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex items-center justify-end gap-3">
					<button type="button" @click="closeEditModal()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
						Batal
					</button>
					<button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
						Simpan Perubahan
					</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		function guruData() {
			return {
				editModalOpen: false,
				selectedData: {},
				openEditModal(data) {
					this.selectedData = { ...data };
					this.editModalOpen = true;
				},
				closeEditModal() {
					this.editModalOpen = false;
					this.selectedData = {};
				},
				saveChanges() {
					console.log('Saving data:', this.selectedData);
					// Add your save API call here
					this.closeEditModal();
				}
			}
		}
	</script>

</x-layouts.app>
