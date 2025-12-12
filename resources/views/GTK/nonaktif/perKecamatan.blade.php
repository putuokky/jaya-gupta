<x-layouts.app :title="__('Data GTK Non Aktif di Kecamatan')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data GTK Non Aktif</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data GTK Non Aktif di Kecamatan</h1>
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
					<table id="nonaktif-perkecamatan-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3 text-center">No</th>
								<th class="px-4 py-3 ">Nama Sekolah</th>
								<th class="px-4 py-3 ">NPSN</th>
								<th class="px-4 py-3 ">BP</th>
								<th class="px-4 py-3 ">Status</th>
								<th class="px-4 py-3 text-center">Laki - laki</th>
								<th class="px-4 py-3 text-center">Perempuan</th>
								<th class="px-4 py-3 text-center">Total</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@php $no = ($data->currentPage() - 1) * $data->perPage() + 1; @endphp
								@foreach($data as $row)
									<tr class="border-t hover:bg-gray-50">
										<td class="px-4 py-3 text-sm text-center">{{ $no++ }}</td>
										<td class="px-4 py-3 text-sm text-blue-600 font-medium">
                                            <a href="{{ URL::to('nonaktif/perSekolah/' . Crypt::encrypt($row->sekolah_id ?? $row['sekolah_id'] ?? '')) }}">
                                            {{ $row->nama ?? $row['nama'] ?? '' }}
                                            </a>
                                        </td>
										<td class="px-4 py-3 text-sm">{{ $row->npsn ?? $row['npsn'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->bentuk_pendidikan ?? $row['bentuk_pendidikan'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->status_sekolah ?? $row['status_sekolah'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_l ?? $row['jumlah_l'] ?? 0 }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_w ?? $row['jumlah_w'] ?? 0 }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ ($row->jumlah_l ?? 0) + ($row->jumlah_w ?? 0) }}</td>
									</tr>
								@endforeach
								<!-- Total Row -->
								<tr class="border-t font-semibold bg-gray-50">
									<td class="px-4 py-3 text-sm" colspan="5">Total</td>
									<td class="px-4 py-3 text-sm text-center">{{ $data->sum(fn($row) => $row->jumlah_l ?? 0) }}</td>
									<td class="px-4 py-3 text-sm text-center">{{ $data->sum(fn($row) => $row->jumlah_w ?? 0) }}</td>
									<td class="px-4 py-3 text-sm text-center">{{ $data->sum(fn($row) => ($row->jumlah_l ?? 0) + ($row->jumlah_w ?? 0)) }}</td>
								</tr>
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="8">No data available</td>
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
