<x-layouts.app :title="__('Dashboard')">
	<style>
		input::placeholder {
			color: #d1d5db;
			opacity: 1;
		}
		section {
			border: 1px solid #e5e7eb;
			border-radius: 0.5rem;
			padding: 1.5rem;
			transition: all 0.2s ease;
		}
		section:hover {
			border-color: #6366f1;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
		}
		.grid {
			border: 1px solid #e5e7eb;
			padding: 1rem;
			border-radius: 0.375rem;
			transition: all 0.2s ease;
		}
		.grid:hover {
			border-color: #6366f1;
			background-color: rgba(99, 102, 241, 0.05);
		}
		input, select, textarea {
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
		}
		input:focus, select:focus, textarea:focus {
			border-color: #6366f1;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
		}
	</style>
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Sekolah {{ $getData->nama }}</h2>
		</div>
	</header>

	<div class="w-full mx-auto px-6 py-6">
		<div class="bg-white shadow rounded-lg overflow-hidden">
			<div class="px-6 py-4 border-b">
				<div class="flex items-center justify-between">
					<div>
						<h2 class="text-lg font-medium text-gray-700">{{ $getData->npsn }} — {{ $getData->nama }}</h2>
						<p class="text-sm text-gray-500">{{ $getData->bentuk_pendidikan }} • {{ $getData->status_sekolah }}</p>
					</div>
					<div class="flex items-center space-x-2">
						<a href="{{ URL::to('gtk/sekolah') }}" class="inline-flex items-center px-3 py-2 border border-gray-200 rounded text-sm text-gray-700 hover:bg-gray-50">&larr; Kembali</a>
						<a href="{{ URL::to('data-sekolah/edit-detail/'.Crypt::encrypt($getData->npsn)) }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">Ubah</a>
					</div>
				</div>
			</div>

			<div class="p-6 space-y-6" x-data="schoolDetail()">
			<!-- Profil Sekolah -->
			<section>
				<h3 class="text-md font-semibold text-gray-700 mb-4">Profil Sekolah</h3>
				<div class="space-y-3">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">1. Nama Sekolah</label>
						<input type="text" x-model="form.nama" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">2. NPSN</label>
						<input type="text" x-model="form.npsn" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">3. Jenjang Pendidikan</label>
						<input type="text" x-model="form.bentuk_pendidikan" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">4. Status Sekolah</label>
						<input type="text" x-model="form.status_sekolah" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">5. Alamat Sekolah</label>
						<textarea x-model="form.alamat" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly rows="3"></textarea>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">RT/RW</label>
						<div class="flex gap-2">
							<input type="text" x-model="form.rt" placeholder="RT" class="flex-1 px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
							<span class="flex items-center">/</span>
							<input type="text" x-model="form.rw" placeholder="RW" class="flex-1 px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Kode Pos</label>
						<input type="text" x-model="form.kodepos" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Kelurahan</label>
						<input type="text" x-model="form.induk_kelurahan" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Kecamatan</label>
						<input type="text" x-model="form.induk_kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Kabupaten/Kota</label>
						<input type="text" x-model="form.induk_kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Provinsi</label>
						<input type="text" x-model="form.induk_provinsi" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">Negara</label>
						<input type="text" x-model="form.induk_negara" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">6. Posisi Geografis</label>
						<div class="space-y-2">
							<div>
								<label class="block text-xs text-gray-500 mb-1">Long:</label>
								<input type="text" x-model="form.long" placeholder="Long" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
							</div>
							<div>
								<label class="block text-xs text-gray-500 mb-1">Lat:</label>
								<input type="text" x-model="form.lat" placeholder="Lat" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- Data Pelengkap -->
			<section>
				<h3 class="text-md font-semibold text-gray-700 mb-4">2. Data Pelengkap</h3>
				<div class="space-y-3">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">7. SK Pendirian Sekolah</label>
						<input type="text" x-model="form.sk_pendirian_sekolah" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">8. Tanggal SK Pendirian</label>
						<input type="date" x-model="form.tgl_sk_pendirian" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">9. Status Kepemilikan</label>
						<input type="text" x-model="form.status_kepemilikan" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">10. SK Izin Operasional</label>
						<input type="text" x-model="form.sk_izin_operasional" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">11. Tgl SK Izin Operasional</label>
						<input type="date" x-model="form.tgl_sk_izin_operasional" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">12. Kebutuhan Khusus Dilayani</label>
						<input type="text" x-model="form.kebutuhan_khusus" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<label class="text-sm text-gray-600 flex items-center">13. No Rekening</label>
					<input type="text" x-model="form.norek" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
				</div>					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">14. Nama Bank</label>
						<input type="text" x-model="form.nama_bank" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<label class="text-sm text-gray-600 flex items-center">15. Cabang KPC/Unit</label>
					<input type="text" x-model="form.kcp_bank" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<label class="text-sm text-gray-600 flex items-center">16. Rekening Atas Nama</label>
					<input type="text" x-model="form.nama_norek" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
				</div>					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">17. MBS</label>
						<input type="text" x-model="form.mbs" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">18. Memungut Iuran</label>
						<input type="text" x-model="form.iuran" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">19. Nominal/Siswa</label>
						<input type="text" x-model="form.nominal_siswa" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">20. Nama Wajib Pajak</label>
						<input type="text" x-model="form.nama_npwp" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">21. NPWP</label>
						<input type="text" x-model="form.no_npwp" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>
				</div>
			</section>

			<!-- Kontak Sekolah -->
			<section>
				<h3 class="text-md font-semibold text-gray-700 mb-4">3. Kontak Sekolah</h3>
				<div class="space-y-3">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">22. Nomor Telepon</label>
						<input type="tel" x-model="form.notelp" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">23. Nomor Tax</label>
						<input type="text" x-model="form.notax" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">24. Alamat Surel</label>
						<input type="email" x-model="form.email" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">25. Website</label>
						<input type="url" x-model="form.website" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>
				</div>
			</section>

				<!-- Data Periodik -->
			<section>
				<h3 class="text-md font-semibold text-gray-700 mb-4">4. Data Periodik</h3>
				<div class="space-y-3">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">26. Waktu Penyelenggaraan</label>
						<input type="text" x-model="form.waktu_penyelenggaraan" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">27. Bersedia Menerima BOS?</label>
						<select x-model="form.is_bos" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly>
							<option value="">-- Pilih --</option>
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">28. Sertifikat ISO</label>
						<input type="text" x-model="form.sertifikat_iso" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">29. Sumber Listrik</label>
						<input type="text" x-model="form.sumber_listrik" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">30. Daya Listrik (watt)</label>
						<input type="text" x-model="form.daya_listrik" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">31. Akses Internet</label>
						<input type="text" x-model="form.akses_internet" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">32. Akses Internet Alternatif</label>
						<input type="text" x-model="form.alternatif_internet" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<label class="text-sm text-gray-600 flex items-center">33. Semester/TA</label>
						<input type="text" x-model="form.semester_ta" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly />
					</div>
				</div>
			</section>
			</div>
		</div>
	</div>

	<script>
		function schoolDetail() {
			return {
				form: {
					nama: '{{ $getData->nama ?? "" }}',
					npsn: '{{ $getData->npsn ?? "" }}',
					bentuk_pendidikan: '{{ $getData->bentuk_pendidikan ?? "" }}',
					status_sekolah: '{{ $getData->status_sekolah ?? "" }}',
					alamat: '{{ $getData->alamat ?? "" }}',
					rt: '{{ $getData->rt ?? "" }}',
					rw: '{{ $getData->rw ?? "" }}',
					kodepos: '{{ $getData->kodepos ?? "" }}',
					induk_kelurahan: '{{ $getData->induk_kelurahan ?? "" }}',
					induk_kecamatan: '{{ $getData->induk_kecamatan ?? "" }}',
					induk_kabupaten: '{{ $getData->induk_kabupaten ?? "" }}',
					induk_provinsi: '{{ $getData->induk_provinsi ?? "" }}',
					induk_negara: '{{ $getData->induk_negara ?? "" }}',
					long: '{{ $getData->long ?? "" }}',
					lat: '{{ $getData->lat ?? "" }}',
					sk_pendirian_sekolah: '{{ $getData->sk_pendirian_sekolah ?? "" }}',
					tgl_sk_pendirian: '{{ $getData->tgl_sk_pendirian ?? "" }}',
					status_kepemilikan: '{{ $getData->status_kepemilikan ?? "" }}',
					sk_izin_operasional: '{{ $getData->sk_izin_operasional ?? "" }}',
					tgl_sk_izin_operasional: '{{ $getData->tgl_sk_izin_operasional ?? "" }}',
				kebutuhan_khusus: '{{ $getData->kebutuhan_khusus ?? "" }}',
				norek: '{{ $getData->norek ?? "" }}',
				nama_bank: '{{ $getData->nama_bank ?? "" }}',
				kcp_bank: '{{ $getData->kcp_bank ?? "" }}',
				nama_norek: '{{ $getData->nama_norek ?? "" }}',
				mbs: '{{ $getData->mbs ?? "" }}',
				iuran: '{{ $getData->iuran ?? "" }}',
				nominal_siswa: '{{ $getData->nominal_siswa ?? "" }}',
				nama_npwp: '{{ $getData->nama_npwp ?? "" }}',
				no_npwp: '{{ $getData->no_npwp ?? "" }}',
					notelp: '{{ $getData->notelp ?? "" }}',
					notax: '{{ $getData->notax ?? "" }}',
					email: '{{ $getData->email ?? "" }}',
					website: '{{ $getData->website ?? "" }}',
					waktu_penyelenggaraan: '{{ $getData->waktu_penyelenggaraan ?? "" }}',
					is_bos: '{{ $getData->is_bos ?? "" }}',
					sertifikat_iso: '{{ $getData->sertifikat_iso ?? "" }}',
					sumber_listrik: '{{ $getData->sumber_listrik ?? "" }}',
					daya_listrik: '{{ $getData->daya_listrik ?? "" }}',
					akses_internet: '{{ $getData->akses_internet ?? "" }}',
					alternatif_internet: '{{ $getData->alternatif_internet ?? "" }}',
					semester_ta: '{{ $getData->semester_ta ?? "" }}'
				}
			}
		}
	</script>

</x-layouts.app>