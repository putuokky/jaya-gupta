<x-layouts.app :title="__('Data Tendik')">
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
	</style>
@endpush

<header class="z-10 py-4 bg-white shadow-md">
	<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
		<h2 class="text-2xl font-semibold text-gray-700">Data Tendik</h2>
	</div>
</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Edit Data Tendik {{ $user->nama }}</h1>
				<a href="{{ url()->previous() }}" class="inline-flex items-center px-3 py-2 border border-gray-200 rounded text-sm text-gray-700 hover:bg-gray-50">&larr; Kembali</a>
			</div>

			<div class="p-6 space-y-6">
				<form action="{{ URL('data-tendik/update') }}" enctype="multipart/form-data" method="POST">
					@csrf
					<input type="hidden" name="id" value="{{ Crypt::encrypt($user->id) }}">

					<!-- Data Tendik Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Data Tendik</h3>
						<div class="space-y-4">
							<!-- Nama & NUPTK -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
									<input type="text" name="nama" value="{{ $user->nama }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NUPTK</label>
									<input type="text" name="nuptk" value="{{ $user->nuptk }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Jenis Kelamin & Tempat Lahir -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
									<select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
										<option value="">-- Pilih Jenis Kelamin --</option>
										<option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
										<option value="W" {{ $user->gender == 'W' ? 'selected' : '' }}>Perempuan</option>
									</select>
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
									<input type="text" name="tempatlahir" value="{{ $user->tempatlahir }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Tanggal Lahir & NIP -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
									<input type="date" name="tanggallahir" value="{{ $user->tanggallahir }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
									<input type="text" name="nip" value="{{ $user->nip }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Status Kepegawaian & Gelar Depan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status Kepegawaian</label>
									<input type="text" name="status_kepegawaian" value="{{ $user->status_kepegawaian }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
									<input type="text" name="gelar_depan" value="{{ $user->gelar_depan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Gelar Belakang & Mengajar -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
									<input type="text" name="gelar_belakang" value="{{ $user->gelar_belakang }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Posisi/Tugas</label>
									<input type="text" name="mengajar" value="{{ $user->mengajar }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Pendidikan Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Pendidikan</h3>
						<div class="space-y-4">
						<!-- Jenjang Pendidikan & Jurusan -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">Jenjang Pendidikan Terakhir</label>
								<select name="pendidikan_terakhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
									<option value="">-- Pilih Jenjang --</option>
									<option value="SMA/SMK" {{ $user->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
									<option value="Diploma" {{ $user->pendidikan_terakhir == 'Diploma' ? 'selected' : '' }}>Diploma</option>
									<option value="S1" {{ $user->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
									<option value="S2" {{ $user->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
									<option value="S3" {{ $user->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
								</select>
							</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Jurusan/Prodi</label>
									<input type="text" name="prodi" value="{{ $user->prodi }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Sertifikasi -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Sertifikasi</label>
									<input type="text" name="sertifikasi" value="{{ $user->sertifikasi }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
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
									<input type="text" name="kecdom" value="{{ $user->kecdom }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
									<input type="text" name="keldom" value="{{ $user->keldom }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Alamat & Kodepos -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Alamat/Nama Dusun</label>
									<input type="text" name="alamat" value="{{ $user->alamat }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Kodepos</label>
									<input type="text" name="kodepos" value="{{ $user->kodepos }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>
						</div>
					</section>

					<!-- Kontak Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Kontak</h3>
						<div class="space-y-4">
							<!-- Telepon & WhatsApp -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">No Telepon</label>
									<input type="text" name="telepon" value="{{ $user->telepon }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">No HP/WA</label>
									<input type="text" name="wa" value="{{ $user->wa }}" onkeypress="return isNumber(event)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Email -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
									<input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
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
									<input type="text" name="tugas_tambahan" value="{{ $user->tugas_tambahan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">SK CPNS</label>
									<input type="text" name="sk_cpns" value="{{ $user->sk_cpns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Tanggal CPNS & SK Pengangkatan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Tanggal CPNS</label>
									<input type="date" name="tgl_cpns" value="{{ $user->tgl_cpns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">SK Pengangkatan</label>
									<input type="text" name="sk_pengangkatan" value="{{ $user->sk_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- TMT Pengangkatan & Lembaga -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">TMT Pengangkatan</label>
									<input type="date" name="tmt_pengangkatan" value="{{ $user->tmt_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Lembaga Pengangkatan</label>
									<input type="text" name="lembaga_pengangkatan" value="{{ $user->lembaga_pengangkatan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Pangkat Golongan & Sumber Gaji -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Pangkat Golongan</label>
									<input type="text" name="golongan" value="{{ $user->golongan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Sumber Gaji</label>
									<input type="text" name="sumber_gaji" value="{{ $user->sumber_gaji }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
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
									<input type="text" name="nm_ibu" value="{{ $user->nm_ibu }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
									<input type="text" name="status_perkawinan" value="{{ $user->status_perkawinan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Nama Pasangan & Pekerjaan Pasangan -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nama Suami/Istri</label>
									<input type="text" name="nm_pasangan" value="{{ $user->nm_pasangan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan Suami/Istri</label>
									<input type="text" name="pekerjaan_pasangan" value="{{ $user->pekerjaan_pasangan }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

						<!-- TMT PNS & Periode Penugasan -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">TMT PNS</label>
								<input type="date" name="tmt_pns" value="{{ $user->tmt_pns }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
							</div>
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">Periode Penugasan (untuk Kepala Sekolah)</label>
								<select name="periode_penugasan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
									<option value="">Pilih</option>
									<option value="Periode 1" {{ ($user->periode_penugasan ?? '') == 'Periode 1' ? 'selected' : '' }}>Periode 1</option>
									<option value="Periode 2" {{ ($user->periode_penugasan ?? '') == 'Periode 2' ? 'selected' : '' }}>Periode 2</option>
									<option value="Periode 3" {{ ($user->periode_penugasan ?? '') == 'Periode 3' ? 'selected' : '' }}>Periode 3</option>
									<option value="Periode 4" {{ ($user->periode_penugasan ?? '') == 'Periode 4' ? 'selected' : '' }}>Periode 4</option>
									<option value="Periode 5" {{ ($user->periode_penugasan ?? '') == 'Periode 5' ? 'selected' : '' }}>Periode 5</option>
								</select>
							</div>
							</div>
						</div>
					</section>

					<!-- Data Identitas Section -->
					<section>
						<h3 class="text-md font-semibold text-gray-700 mb-4">Data Identitas</h3>
						<div class="space-y-4">
						<!-- NIK, KK, Tendik Penggerak & Angkatan GP -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
								<input type="text" name="nik" onkeypress="return isNumber(event)" value="{{ $user->nik }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
							</div>
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">No KK</label>
								<input type="text" name="no_kk" value="{{ $user->no_kk }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
							</div>
						</div>

						<!-- Tendik Penggerak & Angkatan GP -->
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">Tendik Penggerak</label>
								<select name="is_penggerak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
									<option value="">lya</option>
									<option value="Ya" {{ ($user->is_penggerak ?? '') == 'Ya' ? 'selected' : '' }}>Ya</option>
									<option value="Tidak" {{ ($user->is_penggerak ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
								</select>
							</div>
							<div>
								<label class="block text-sm font-medium text-gray-700 mb-2">Angkatan GP</label>
								<select name="angkatan_gp" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
									<option value="">0</option>
									<option value="1" {{ ($user->angkatan_gp ?? '') == '1' ? 'selected' : '' }}>1</option>
									<option value="2" {{ ($user->angkatan_gp ?? '') == '2' ? 'selected' : '' }}>2</option>
									<option value="3" {{ ($user->angkatan_gp ?? '') == '3' ? 'selected' : '' }}>3</option>
									<option value="4" {{ ($user->angkatan_gp ?? '') == '4' ? 'selected' : '' }}>4</option>
									<option value="5" {{ ($user->angkatan_gp ?? '') == '5' ? 'selected' : '' }}>5</option>
								</select>
							</div>
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
									<input type="text" name="npwp" value="{{ $user->npwp }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Bank</label>
									<input type="text" name="bank" value="{{ $user->bank }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
							</div>

							<!-- Nomor Rekening & Nama Rekening -->
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Nomor Rekening Bank</label>
									<input type="text" name="norek_bank" value="{{ $user->norek_bank }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
								</div>
								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Rekening Atas Nama</label>
									<input type="text" name="nama_norek" value="{{ $user->nama_norek }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
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
	</div>

@push('js-custom')
<script src="{{ URL::to('/') }}/assets/modules/select2/dist/js/select2.full.min.js"></script>
<script>
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>
@endpush

</x-layouts.app>
