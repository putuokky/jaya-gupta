<x-layouts.app :title="__('Data Guru per Sekolah')">
@push('css-custom')
	<!-- CSS Libraries -->
	<link rel="stylesheet" href="{{ URL::to('/') }}/assets/modules/select2/dist/css/select2.min.css">
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
			background-color: #fafafa;
		}
		section:hover {
			border-color: #6366f1;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
			background-color: #fff;
		}
		section h3 {
			color: #1f2937;
			font-weight: 600;
		}
		input, select, textarea {
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
			font-size: 0.875rem;
		}
		input:focus, select:focus, textarea:focus {
			border-color: #6366f1 !important;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
			outline: none;
		}
		/* Form Control Styling for legacy inputs */
		.form-control {
			border: 1px solid #d1d5db !important;
			border-radius: 0.375rem !important;
			padding: 0.5rem 0.75rem !important;
			font-size: 0.875rem !important;
			transition: all 0.2s ease !important;
		}
		.form-control:focus {
			border-color: #6366f1 !important;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
		}
		.form-group {
			margin-bottom: 0 !important;
		}
		.form-group label {
			font-weight: 500;
			color: #374151;
			margin-bottom: 0.5rem;
			display: block;
			font-size: 0.875rem;
		}
		.col-md-12 {
			width: 100%;
		}
		/* Button Styling */
		button[type="submit"] {
			transition: all 0.2s ease;
		}
		button[type="submit"]:hover {
			transform: translateY(-1px);
		}
		a.hover\:bg-gray-100:hover {
			background-color: #f3f4f6;
		}
		/* Photo Upload Preview */
		.photo-preview {
			width: 120px;
			height: 120px;
			border: 2px solid #e5e7eb;
			border-radius: 0.5rem;
			object-fit: cover;
		}
		.photo-preview:hover {
			border-color: #6366f1;
		}
	</style>
@endpush

<header class="z-10 py-4 bg-white shadow-md">
	<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
		<h2 class="text-2xl font-semibold text-gray-700">Data Guru</h2>
	</div>
</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Edit Data Guru {{ $guru->nama }}</h1>
				<a href="{{ url()->previous() }}" class="inline-flex items-center px-3 py-2 border border-gray-200 rounded text-sm text-gray-700 hover:bg-gray-50">&larr; Kembali</a>
			</div>

			<div class="p-6 space-y-6">
				<form action="{{ URL('data-guru/update') }}" enctype="multipart/form-data" method="POST">
					@csrf
					<input type="hidden" name="id" value="{{ Crypt::encrypt($guru->id) }}">
					
					<!-- Profil Guru Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Profil Guru</h3>
						<div class="space-y-4">
							<!-- Foto Guru -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Foto Guru</label>
									<div class="mb-3">
										<img id="preview-image-before-upload" src="{{ URL::to('/') }}/{{ $guru->profile_picture }}" alt="preview image" style="max-height: 200px; border-radius: 0.375rem;">
									</div>
									<input type="file" name="image" id="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
									@error('picture')
										<div class="text-red-500 text-sm mt-1">{{ $message }}</div>
									@enderror
								</div>
								<div></div>
							</div>

							<!-- Nama Guru -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nama Guru <span class="text-red-500">*</span></label>
									<input type="text" name="nama_lengkap" value="{{ $guru->nama_lengkap }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Tanpa Gelar" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
									<select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
										<option value="">Pilih</option>
										<option value="L" {{ $guru->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
										<option value="P" {{ $guru->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
									</select>
								</div>
							</div>

							<!-- Gelar -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
									<input type="text" name="gelar_depan" value="{{ $guru->gelar_depan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
									<input type="text" name="gelar_blkg" value="{{ $guru->gelar_belakang }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Data Guru Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Data Guru</h3>
						<div class="space-y-4">
							<!-- Asal Sekolah & NUPTK -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Asal Sekolah</label>
									<select name="asal_satuan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 select2">
										<option value="">-- Pilih Asal Sekolah --</option>
										@foreach ($data['asal_satuan'] as $item)
											<option value="{{ $item->npsn }}" {{ $guru->asal_satuan_pendidikan == $item->npsn ? 'selected' : '' }}>
												{{ $item->npsn . ' - ' . $item->nama }}</option>
										@endforeach
									</select>
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NUPTK</label>
									<input type="text" name="nuptk" value="{{ $guru->nuptk }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Pendidikan & Status Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Pendidikan & Status</h3>
						<div class="space-y-4">
							<!-- Status Kepegawaian & Jenjang -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status Kepegawaian</label>
									<input type="text" name="status_kepegawaian" value="{{ $guru->status_kepegawaian }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jenjang Pendidikan Terakhir</label>
									<select name="jenjang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
										<option value="">-- Pilih Jenjang --</option>
										@foreach ($data['jenjang'] as $item)
											<option value="{{ $item->kode }}" {{ $guru->pendidikan_terakhir == $item->nama ? 'selected' : '' }}>
												{{ $item->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<!-- Jurusan & Mengajar -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jurusan/Prodi Pendidikan</label>
									<input type="text" name="jurusan" value="{{ $guru->prodi }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Mengajar</label>
									<select name="mengajar" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
										<option value="">Pilih</option>
										<option value="Guru Kelas" {{ 'Guru Kelas' == $guru->mengajar ? 'selected' : '' }}>Guru Kelas</option>
										@foreach ($data['mapel'] as $item)
											<option value="{{ $item->nama }}" {{ $item->nama == $guru->mengajar ? 'selected' : '' }}>{{ $item->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<!-- Sertifikasi -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Sertifikasi</label>
									<input type="text" name="sertifikasi" value="{{ $guru->sertifikasi }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div></div>
							</div>
						</div>
					</section>

					<!-- Domisili Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Domisili</h3>
						<div class="space-y-4">
							<!-- Kecamatan & Kelurahan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
									<input type="text" name="kecdom" value="{{ $guru->kecdom }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
									<input type="text" name="keldom" value="{{ $guru->keldom }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Alamat & Kodepos -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Alamat/Nama Dusun</label>
									<input type="text" name="alamat" value="{{ $guru->alamat }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Kodepos</label>
									<input type="text" name="kodepos" value="{{ $guru->kodepos }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Narahubung Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Narahubung</h3>
						<div class="space-y-4">
							<!-- Telepon & WhatsApp -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">No Telepon</label>
									<input type="text" name="telepon" value="{{ $guru->telepon }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">No HP/WA</label>
									<input type="text" name="wa" value="{{ $guru->wa }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Email -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
									<input type="email" name="email" value="{{ $guru->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div></div>
							</div>
						</div>
					</section>

					<!-- Kepegawaian Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Kepegawaian</h3>
						<div class="space-y-4">
							<!-- Tugas Tambahan & SK CPNS -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Tugas Tambahan</label>
									<input type="text" name="tugas_tambahan" value="{{ $guru->tugas_tambahan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">SK CPNS</label>
									<input type="text" name="sk_cpns" value="{{ $guru->sk_cpns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Tanggal CPNS & SK Pengangkatan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Tanggal CPNS</label>
									<input type="date" name="tgl_cpns" value="{{ $guru->tgl_cpns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">SK Pengangkatan</label>
									<input type="text" name="sk_pengangkatan" value="{{ $guru->sk_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- TMT Pengangkatan & Lembaga -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">TMT Pengangkatan</label>
									<input type="date" name="tmt_pengangkatan" value="{{ $guru->tmt_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Lembaga Pengangkatan</label>
									<input type="text" name="lembaga_pengangkatan" value="{{ $guru->lembaga_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Pangkat Golongan & Sumber Gaji -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Pangkat Golongan</label>
									<input type="text" name="golongan" value="{{ $guru->golongan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Sumber Gaji</label>
									<input type="text" name="sumber_gaji" value="{{ $guru->sumber_gaji }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Keluarga/Pribadi Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Keluarga/Pribadi</h3>
						<div class="space-y-4">
							<!-- Nama Ibu & Status Perkawinan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu Kandung</label>
									<input type="text" name="nm_ibu" value="{{ $guru->nm_ibu }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
									<input type="text" name="status_perkawinan" value="{{ $guru->status_perkawinan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Nama Pasangan & NIP Pasangan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nama Suami/Istri</label>
									<input type="text" name="nm_pasangan" value="{{ $guru->nm_pasangan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NIP Suami/Istri</label>
									<input type="text" name="nip_pasangan" value="{{ $guru->nip_pasangan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Pekerjaan Pasangan & TMT PNS -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Suami/Istri</label>
									<input type="text" name="pekerjaan_pasangan" value="{{ $guru->pekerjaan_pasangan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">TMT PNS</label>
									<input type="text" name="tmt_pns" value="{{ $guru->tmt_pns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Data Identitas Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Data Identitas</h3>
						<div class="space-y-4">
							<!-- NIK & KK -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
									<input type="text" name="nik" onkeypress="return isNumber(event)" value="{{ $guru->nik }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">No KK</label>
									<input type="text" name="no_kk" value="{{ $guru->no_kk }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Guru Penggerak -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Guru Penggerak</label>
									<input type="text" name="is_penggerak" value="{{ $guru->is_penggerak }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div></div>
							</div>
						</div>
					</section>

					<!-- Rekening Bank Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Rekening Bank</h3>
						<div class="space-y-4">
							<!-- NPWP & Bank -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NPWP</label>
									<input type="text" name="npwp" value="{{ $guru->npwp }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Bank</label>
									<input type="text" name="bank" value="{{ $guru->bank }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Nomor Rekening & Nama Rekening -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening Bank</label>
									<input type="text" name="norek_bank" value="{{ $guru->norek_bank }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Rekening Atas Nama</label>
									<input type="text" name="nama_norek" value="{{ $guru->nama_norek }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Performa & Tugas Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Performa & Tugas</h3>
						<div class="space-y-4">
							<!-- Jam Tgs Tambahan & JJM -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jam Tugas Tambahan</label>
									<input type="text" name="jam_tgs_tambahan" onkeypress="return isNumber(event)" value="{{ $guru->jam_tgs_tambahan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">JJM</label>
									<input type="text" name="jjm" onkeypress="return isNumber(event)" value="{{ $guru->jjm }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Siswa & Status Sekolah -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Siswa</label>
									<input type="text" name="siswa" onkeypress="return isNumber(event)" value="{{ $guru->siswa }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status Sekolah</label>
									<input type="text" name="status_sekolah" value="{{ $guru->status_sekolah }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Form Actions -->
					<div class="flex justify-between items-center pt-6 border-t">
						<a href="{{ URL::previous() }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
							Batal
						</a>
						<button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
							Simpan Perubahan
						</button>
				</div>
			</form>
		</div>
	</div>

@push('js-custom')
<script src="{{ URL::to('/') }}/assets/modules/select2/dist/js/select2.full.min.js"></script>
<script>
        $(document).ready(function() {
            $('#provdom').val('{{ $guru->provdom }}').trigger('change');
            $('#kabdom').val('{{ $guru->kabdom }}').trigger('change');
            $('#kecdom').val('{{ $guru->kecdom }}').trigger('change');

            $('#image').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
        });

        $('.hapus-btn').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Data akan dihapus',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    swal('Data Telah dihapus', {
                        icon: 'success',
                    });
                    if (isConfirm) form.submit();
                } else {
                    swal('Tidak Ada perubahan');
                }
            });
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

    <script>
        $('#provdom').change(function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    type: "GET",
                    url: "/ajax/getkabupaten/" + province_id,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#kabdom").empty();
                            $("#kabdom").append('<option>--- Pilih Kabupaten ---</option>');
                            $.each(res, function(name, id) {
                                $("#kabdom").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                            $('#kabdom').val('{{ $guru->kabdom }}').trigger('change');
                        } else {
                            $("#kabdom").empty();
                        }
                    }
                });
            } else {
                $("#kabdom").empty();
            }
        });

        $('#kabdom').change(function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    type: "GET",
                    url: "/ajax/getkecamatan/" + province_id,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#kecdom").empty();
                            $("#kecdom").append('<option>--- Pilih Kecamatan ---</option>');
                            $.each(res, function(name, id) {
                                $("#kecdom").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                            $('#kecdom').val('{{ $guru->kecdom }}').trigger('change');
                        } else {
                            $("#kecdom").empty();
                        }
                    }
                });
            } else {
                $("#kecdom").empty();
            }
        });

        $('#kecdom').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: "/ajax/getkelurahan/" + id,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#keldom").empty();
                            $("#keldom").append('<option>--- Pilih Kelurahan ---</option>');
                            $.each(res, function(name, id) {
                                $("#keldom").append('<option value="' + id + '">' + name +
                                    '</option>');
                            });
                            $('#keldom').val('{{ $guru->keldom }}').trigger('change');
                        } else {
                            $("#keldom").empty();
                        }
                    }
                });
            } else {
                $("#keldom").empty();
            }
        });
    </script>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.image-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(ofREvent) {
                imgPreview.src = ofREvent.target.result;
            }
        }
    </script>

@if (session()->has('error'))
<script>
    $(document).ready(function() {
        iziToast.warning({
            title: 'Gagal !',
            message: "{{ session('error') }}",
            position: 'topRight'
        });
    });
</script>
@endif

@if (session()->has('success'))
<script>
    $(document).ready(function() {
        iziToast.success({
            title: 'Sukses !',
            message: "{{ session('success') }}",
            position: 'topRight'
        });
    });
</script>
@endif
</script>
@endpush

</x-layouts.app>