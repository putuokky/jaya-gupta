
						<x-layouts.app :title="__('Data Sekolah')">
	<header class="z-10 py-4 bg-white shadow-md">
			<div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
				<h2 class="text-2xl font-semibold text-gray-700">Data Sekolah di Denpasar</h2>
			</div>
		</header>
							<div class="w-full mx-auto px-6 py-6">
						
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
												@foreach ($data as $item)
													
												
												<tr class="border-b">
													<td class="px-4 py-3">1</td>
													<td class="px-4 py-3 text-indigo-600">
														  @php
                                                        $kode_wil = trim($item['kode_wil']);
                                                        $kode_wil = Crypt::encrypt($kode_wil);
                                                    @endphp
                                                    <a href="{{ URL::to('data-sekolah/show/3/' . $kode_wil) }}">
														
														
															{{ $item->induk_kecamatan }}
														</a>
														
													</td>
													<td class="px-4 py-3 text-center">{{ $item->total }}</td>
													<td class="px-4 py-3 text-center">{{ $item->tk }}</td>
													<td class="px-4 py-3 text-center">{{ $item->sd }}</td>
													<td class="px-4 py-3 text-center">{{ $item->smp }}</td>
												</tr>
											@endforeach
											</tbody>
											<tfoot>
												<tr class="bg-gray-50">
													<td colspan="2" class="px-4 py-3 font-semibold text-right">Total</td>
													<td class="px-4 py-3 text-center font-semibold">{{$data->sum('total')}}</td>
													<td class="px-4 py-3 text-center font-semibold">{{$data->sum('tk')}}</td>
													<td class="px-4 py-3 text-center font-semibold">{{$data->sum('sd')}}</td>
													<td class="px-4 py-3 text-center font-semibold">{{$data->sum('smp')}}</td>
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
