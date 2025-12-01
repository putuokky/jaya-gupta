<x-layouts.app :title="__('Dashboard')">

    
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

            <div class="p-6 space-y-6">
                <!-- Profil Sekolah -->
                <section>
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Profil Sekolah</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr class="py-2">
                                    <td class="w-1/3 py-3 text-sm text-gray-600">1. Nama Sekolah</td>
                                    <td class="w-6 py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">2. NPSN</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->npsn }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">3. Jenjang Pendidikan</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->bentuk_pendidikan }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">4. Status Sekolah</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->status_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">5. Alamat Sekolah</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;RT/RW</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->rt }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;KodePos</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->kodepos }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;Kelurahan</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_kelurahan }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;Kabupaten/Kota</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_kabupaten }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;Provinsi</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_provinsi }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">&nbsp;&nbsp;&nbsp;&nbsp;Negara</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">6. Posisi Geografis</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">Long : <br> Lat :</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Data Pelengkap -->
                <section>
                    <h3 class="text-md font-semibold text-gray-700 mb-3">2. Data Pelengkap</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr>
                                    <td class="w-1/3 py-3 text-sm text-gray-600">7. SK Pendirian Sekolah</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">8. Tanggal SK Pendirian</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                                <!-- keep remaining fields similarly -->
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">19. Nominal/Siswa</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->PesertaDidik_count }} Siswa</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Kontak Sekolah -->
                <section>
                    <h3 class="text-md font-semibold text-gray-700 mb-3">3. Kontak Sekolah</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr>
                                    <td class="w-1/3 py-3 text-sm text-gray-600">22. Nomor Telepon</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">24. Alamat Surel</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Data Periodik -->
                <section>
                    <h3 class="text-md font-semibold text-gray-700 mb-3">4. Data Periodik</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr>
                                    <td class="w-1/3 py-3 text-sm text-gray-600">26. Waktu Penyelenggaran</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-sm text-gray-600">31. Akses Internet</td>
                                    <td class="py-3 text-sm text-gray-600">:</td>
                                    <td class="py-3 text-sm text-gray-800">{{ $getData->induk_negara }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

</x-layouts.app>