<x-layouts.app :title="__('Data Tendik di Denpasar')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Tendik</h2>
		</div>
	</header>

	<div class="mx-auto px-6 py-6">
		<div class="bg-white rounded shadow overflow-hidden">
			<div class="flex items-center justify-between bg-indigo-50 p-6">
				<h1 class="text-lg text-gray-700 font-semibold">Data Tendik di Denpasar</h1>
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
					<table id="tendik-index-table" class="min-w-full divide-y table-auto" style="width:100%">
						<thead class="bg-gray-100">
							<tr class="text-left text-sm text-gray-600 border-b">
								<th class="px-4 py-3" rowspan="2">No</th>
								<th class="px-4 py-3" rowspan="2">Wilayah</th>
								<th class="px-4 py-3" colspan="3" style="text-align: center;">Total</th>
								<th class="px-4 py-3" colspan="3" style="text-align: center;">TK</th>
								<th class="px-4 py-3" colspan="3" style="text-align: center;">SD</th>
								<th class="px-4 py-3" colspan="3" style="text-align: center;">SMP</th>
							</tr>
							<tr class="text-left text-sm text-gray-600">
								<th class="px-4 py-3">Jml</th>
								<th class="px-4 py-3">L</th>
								<th class="px-4 py-3">P</th>
								<th class="px-4 py-3">Jml</th>
								<th class="px-4 py-3">L</th>
								<th class="px-4 py-3">P</th>
								<th class="px-4 py-3">Jml</th>
								<th class="px-4 py-3">L</th>
								<th class="px-4 py-3">P</th>
								<th class="px-4 py-3">Jml</th>
								<th class="px-4 py-3">L</th>
								<th class="px-4 py-3">P</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							@if(isset($data) && $data->count())
								@php $no = 1; @endphp
								@foreach($data as $row)
									<tr class="border-t hover:bg-gray-50">
										<td class="px-4 py-3 text-sm">{{ $no++ }}</td>
										<td class="px-4 py-3 text-sm text-blue-600 font-medium">
											<a href="{{ route('tendik.perWilayah', encrypt($row->kode_wilayah_induk_kecamatan )) }}">
												{{ $row->induk_kecamatan ?? $row['induk_kecamatan'] ?? '' }}
											</a>
										</td>
										<!-- Total -->
										<td class="px-4 py-3 text-sm text-center">{{$row->jumlah_l + $row->jumlah_w}}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_l  }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->jumlah_w }}</td>
										<!-- TK -->
										<td class="px-4 py-3 text-sm text-center">{{ $row->tk_l + $row->tk_p }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->tk_l }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->tk_p  }}</td>
										<!-- SD -->
										<td class="px-4 py-3 text-sm text-center">{{ $row->sd_l + $row->sd_p }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->sd_l  }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->sd_p }}</td>
										<!-- SMP -->
										<td class="px-4 py-3 text-sm text-center">{{ $row->smp_l + $row->smp_p }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->smp_l }}</td>
										<td class="px-4 py-3 text-sm text-center">{{ $row->smp_p }}</td>
									</tr>
								@endforeach
								<!-- Total Row -->
								
							@else
								<tr>
									<td class="px-4 py-6 text-center text-gray-500" colspan="13">No data available</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>

</x-layouts.app>
