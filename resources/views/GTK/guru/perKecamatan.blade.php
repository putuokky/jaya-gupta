<x-layouts.app :title="__('Data Guru per Kecamatan')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Guru</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data Guru di Kec. {{ $data[0]?->induk_kecamatan ?? '...' }}</h1>
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
					<table id="guru-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3">No</th>
								<th class="px-4 py-3">Nama Sekolah</th>
								<th class="px-4 py-3">NPSN</th>
								<th class="px-4 py-3">BP</th>
								<th class="px-4 py-3">Status</th>
								<th class="px-4 py-3 text-center">Laki - laki</th>
								<th class="px-4 py-3 text-center">Perempuan</th>
								<th class="px-4 py-3 text-center">Total</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@foreach($data as $i => $row)
									<tr class="border-t even:bg-white odd:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
										<td class="px-4 py-3 text-sm text-blue-600">
											<a href="{{ route('guru.perSekolah', encrypt($row->npsn)) }}">{{ $row->nama }}</a>
											</td>
										<td class="px-4 py-3 text-sm">{{ $row->npsn ?? $row['npsn'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->bentuk_pendidikan ?? $row['bentuk_pendidikan'] ?? $row->bp ?? $row['bp'] ?? '' }}</td>
										<td class="px-4 py-3 text-sm">{{ $row->status_sekolah ?? $row['status_sekolah'] ?? $row->status ?? $row['status'] ?? '' }}</td>
										
										{{-- Guru counts --}}
										<td class="px-4 py-3 text-sm text-center">{{ $row->laki_laki_count }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->perempuan_count }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->laki_laki_count + $row->perempuan_count }}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="8">No data available</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

				{{-- Totals row --}}
				<div class="mt-4 px-4">
					<div class="flex justify-end gap-4 font-semibold text-sm">
						<span>Total</span>
						<span class="w-24 text-center">{{ $data->sum('guru_laki_laki') ?? 0 }}</span>
						<span class="w-24 text-center">{{ $data->sum('guru_perempuan') ?? 0 }}</span>
						<span class="w-24 text-center">{{ $data->sum('guru_total') ?? 0 }}</span>
					</div>
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

	{{-- DataTables scripts --}}
	

</x-layouts.app>
