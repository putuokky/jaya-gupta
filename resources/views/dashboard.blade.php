
<x-layouts.app :title="__('Beranda')">

	<div class="container mx-auto px-6 py-6">
		<h2 class="text-2xl font-semibold text-gray-700 mb-4">Data Sekolah di Denpasar</h2>

		<div class="bg-blue-200 border-l-4 border-blue-400 text-blue-800 p-4 rounded mb-6">
			<div class="flex items-center justify-between">
				<div>Data Sekolah bersumber dari <code class="bg-white px-1 py-0.5 rounded text-sm">dapo.kemdikbud.go.id</code></div>
				<button class="text-white bg-blue-500 px-2 py-1 rounded opacity-0">x</button>
			</div>
		</div>

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
				<table id="schools-summary" class="min-w-full table-auto border-collapse" style="width:100%">
					<thead>
						<tr class="bg-gray-100 text-sm text-gray-600 border-b">
							<th rowspan="2" class="px-4 py-3">No</th>
							<th rowspan="2" class="px-4 py-3">Wilayah</th>
							<th colspan="1" class="px-4 py-3 text-center">Total</th>
							<th colspan="1" class="px-4 py-3 text-center">TK</th>
							<th colspan="1" class="px-4 py-3 text-center">SD</th>
							<th colspan="1" class="px-4 py-3 text-center">SMP</th>
						</tr>
						<tr class="bg-gray-100 text-sm text-gray-600 border-b">
							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">Jml</th>
							<th class="px-4 py-2 text-center">Jml</th>
						</tr>
					</thead>
					<tbody>
						<tr class="border-b">
							<td class="px-4 py-3">1</td>
							<td class="px-4 py-3 text-indigo-600">Kec. Denpasar Barat</td>
							<td class="px-4 py-3 text-center">159</td>
							<td class="px-4 py-3 text-center">86</td>
							<td class="px-4 py-3 text-center">57</td>
							<td class="px-4 py-3 text-center">16</td>
						</tr>
						<tr class="border-b">
							<td class="px-4 py-3">2</td>
							<td class="px-4 py-3 text-indigo-600">Kec. Denpasar Selatan</td>
							<td class="px-4 py-3 text-center">160</td>
							<td class="px-4 py-3 text-center">74</td>
							<td class="px-4 py-3 text-center">65</td>
							<td class="px-4 py-3 text-center">21</td>
						</tr>
						<tr class="border-b">
							<td class="px-4 py-3">3</td>
							<td class="px-4 py-3 text-indigo-600">Kec. Denpasar Timur</td>
							<td class="px-4 py-3 text-center">121</td>
							<td class="px-4 py-3 text-center">55</td>
							<td class="px-4 py-3 text-center">52</td>
							<td class="px-4 py-3 text-center">14</td>
						</tr>
						<tr class="border-b">
							<td class="px-4 py-3">4</td>
							<td class="px-4 py-3 text-indigo-600">Kec. Denpasar Utara</td>
							<td class="px-4 py-3 text-center">149</td>
							<td class="px-4 py-3 text-center">75</td>
							<td class="px-4 py-3 text-center">55</td>
							<td class="px-4 py-3 text-center">19</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="bg-gray-50">
							<td colspan="2" class="px-4 py-3 font-semibold text-right">Total</td>
							<td class="px-4 py-3 text-center font-semibold">589</td>
							<td class="px-4 py-3 text-center font-semibold">290</td>
							<td class="px-4 py-3 text-center font-semibold">229</td>
							<td class="px-4 py-3 text-center font-semibold">70</td>
						</tr>
					</tfoot>
				</table>
			</div>

			<div class="flex items-center justify-between mt-4 text-sm text-gray-600">
				<div>Showing 1 to 4 of 4 entries</div>
				<div>
					<nav aria-label="Table navigation">
						<ul class="inline-flex items-center">
							<li>
								<button class="px-3 py-1 text-gray-400">Previous</button>
							</li>
							<li>
								<button class="px-3 py-1 bg-purple-600 text-white rounded">1</button>
							</li>
							<li>
								<button class="px-3 py-1 text-gray-400">Next</button>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>

	{{-- DataTables CDN and init to wire length/select and search --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var table = $('#schools-summary').DataTable({
				dom: 'lfrtip',
				paging: true,
				pageLength: 10,
				ordering: false,
				info: true,
				language: {
					search: "",
					searchPlaceholder: "",
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
		});
	</script>

</x-layouts.app>
