<x-layouts.app :title="__('Data Peserta Didik')">
	<header class="z-10 py-4 bg-white shadow-md">
		<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
			<h2 class="text-2xl font-semibold text-gray-700">Data Peserta Didik di Denpasar</h2>
		</div>
	</header>

	<div class="w-full mx-auto px-6 py-6">

		@php
			// ensure $data is a collection and inject sample row when empty
			$data = collect(isset($data) ? $data : []);
     
		@endphp

		<div class="bg-white rounded shadow p-4">
			<div class="flex items-center justify-between mb-4">
				<div>
					<label class="text-sm mr-2">Show</label>
					<select id="length" class="border rounded px-2 py-1">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					<span class="text-sm ml-2">entries</span>
				</div>

				<div class="flex items-center">
					<label class="mr-2 text-sm text-gray-600">Search:</label>
					<input id="dt-search" type="text" class="border rounded px-3 py-1" />
				</div>
			</div>

			<div class="overflow-x-auto">
				<table id="students-summary" class="min-w-full table-auto border-collapse" style="width:100%">
					<thead>
						<tr class="bg-gray-100 text-sm text-gray-600 border-b">
							<th rowspan="2" class="px-4 py-3">No</th>
							<th rowspan="2" class="px-4 py-3">Wilayah</th>
							<th colspan="3" class="px-4 py-3 text-center">Total</th>
							<th colspan="3" class="px-4 py-3 text-center">TK</th>
							<th colspan="3" class="px-4 py-3 text-center">SD</th>
							<th colspan="3" class="px-4 py-3 text-center">SMP</th>
						</tr>
						<tr class="bg-gray-100 text-sm text-gray-600 border-b">
							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">L</th>
							<th class="px-4 py-2 text-center">P</th>

							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">L</th>
							<th class="px-4 py-2 text-center">P</th>

							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">L</th>
							<th class="px-4 py-2 text-center">P</th>

							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">L</th>
							<th class="px-4 py-2 text-center">P</th>
						</tr>
					</thead>
					<tbody>
						@php 
						$total = 0;
						$total_l = 0;
						$total_p = 0;
						@endphp
						@foreach ($data as $index => $item)
						<tr class="border-b even:bg-white odd:bg-gray-50">
							<td class="px-4 py-3">{{ $index + 1 }}</td>
							<td class="px-4 py-3 text-indigo-600">
								@php
									$kode_wil = isset($item['kode_wil']) ? trim($item['kode_wil']) : '';
									$kode_wil = $kode_wil ? Crypt::encrypt($kode_wil) : '';
									$item->jml =($item->tk_l + $item->tk_p) + ($item->sd_l + $item->sd_p) +($item->smp_l + $item->smp_p);
									$total += $item->jml;
									$total_l += ($item->tk_l + $item->sd_l + $item->smp_l);
									$total_p += ($item->tk_p + $item->sd_p + $item->smp_p);
								@endphp
								@if($kode_wil)
									<a href="{{ URL::to('data-peserta-didik/show/' . $kode_wil) }}">{{ $item->induk_kecamatan ?? ($item['induk_kecamatan'] ?? '-') }}</a>
								@else
									{{ $item->induk_kecamatan ?? ($item['induk_kecamatan'] ?? '-') }}
								@endif
							</td>

							{{-- Total --}}
							
							<td class="px-4 py-3 text-right">{{ number_format($item->jml ?: 0) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format( ($item->tk_l ?? 0) + ($item->sd_l ?? 0) + ($item->smp_l ?? 0) ) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format( ($item->tk_p ?? 0) + ($item->sd_p ?? 0) + ($item->smp_p ?? 0) ) }}</td>

							{{-- TK --}}
							<td class="px-4 py-3 text-right">{{ number_format( ($item->tk_l ?? 0) + ($item->tk_p ?? 0) ) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->tk_l ?? 0) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->tk_p ?? 0) }}</td>

							{{-- SD --}}
							<td class="px-4 py-3 text-right">{{ number_format( ($item->sd_l ?? 0) + ($item->sd_p ?? 0) ) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->sd_l ?? 0) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->sd_p ?? 0) }}</td>

							{{-- SMP --}}
							<td class="px-4 py-3 text-right">{{ number_format( ($item->smp_l ?? 0) + ($item->smp_p ?? 0) ) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->smp_l ?? 0) }}</td>
							<td class="px-4 py-3 text-right">{{ number_format($item->smp_p ?? 0) }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="bg-gray-50">
							<td colspan="2" class="px-4 py-3 font-semibold text-right">Total</td>
							<td class="px-4 py-3 text-right font-semibold" style="text-align: right">{{ number_format($total) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($total_l) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($total_p) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('tk_l')+$data->sum('tk_p')) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('tk_l') ?: 0) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('tk_p') ?: 0) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('sd_l')+$data->sum('sd_p')) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('sd_l') ?: 0) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('sd_p') ?: 0) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('smp_l')+$data->sum('smp_p')) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('smp_l') ?: 0) }}</td>
							<td class="px-4 py-3 text-right font-semibold"  style="text-align: right">{{ number_format($data->sum('smp_p') ?: 0) }}</td>
						</tr>
					</tfoot>
				</table>
			</div>

			<!-- placeholder for DataTables pagination (will be replaced by DataTables) -->
			<div class="mt-6">
				<div id="dt-pagination" class="flex justify-center"></div>
			</div>
		</div>
	</div>

	{{-- DataTables CDN and init to wire length/select and search --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<style>
		/* center DataTables pagination and style minimally to match template */
		.dataTables_wrapper .dataTables_paginate { display:flex; justify-content:center; margin-top:1rem; }
		.dataTables_wrapper .dataTables_info { padding-top: .5rem; }
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// init DataTable with pagination and info only (we use our custom length/search controls)
			var table = $('#students-summary').DataTable({
				paging: true,
				info: true,
				searching: true,
				pageLength: 10,
				lengthChange: false,
				// show only table, info and pagination
				dom: 'tip',
				language: {
					paginate: { previous: '‹', next: '›' }
				}
			});

			// wire custom search input to DataTables search
			$('#dt-search').on('keyup', function () {
				table.search(this.value).draw();
			});

			// wire custom length select
			$('#length').on('change', function () {
				table.page.len(Number(this.value)).draw();
			});

			// move the default DataTables pagination into our placeholder (centered)
			var dtPagination = $('.dataTables_paginate');
			if (dtPagination.length) {
				$('#dt-pagination').html(dtPagination);
			}
		});
	</script>

</x-layouts.app>
