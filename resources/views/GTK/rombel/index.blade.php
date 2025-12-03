<x-layouts.app :title="__('Data Rombel di Denpasar')">
    <header class="z-10 py-4 bg-white shadow-md">
        <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
            <h2 class="text-2xl font-semibold text-gray-700">Data Rombel di Denpasar</h2>
        </div>
    </header>

    <div class="mx-auto px-6 py-6">
        <div class="bg-white rounded shadow overflow-hidden">
            <div class="p-4">
                <div class="bg-blue-300 rounded p-3 text-blue-900 flex items-center justify-between">
                    <div>Data Sekolah bersumber dari <code class="bg-white px-1 rounded text-red-600">dapo.kemdikbud.go.id</code></div>
                    <button class="text-white opacity-60 hover:opacity-100">✕</button>
                </div>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y table-auto" style="width:100%">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-sm text-gray-600">
                                <th class="px-6 py-5">No</th>
                                <th class="px-6 py-5">Wilayah</th>
                                <th class="px-6 py-5 text-center">Total</th>
                                <th class="px-6 py-5 text-center">TK</th>
                                <th class="px-6 py-5 text-center">SD</th>
                                <th class="px-6 py-5 text-center">SMP</th>
                            </tr>
                            <tr class="text-left text-sm text-gray-600 bg-gray-100">
                                <th></th>
                                <th></th>
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">Jml</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @php
                                // fallback sample row if no data passed
                                if(!isset($data) || (is_countable($data) && count($data) === 0)){
                                    $data = collect([ (object)[
                                        'wilayah' => 'Kec. Denpasar Timur',
                                        'total' => 0,
                                        'tk' => 0,
                                        'sd' => 0,
                                        'smp' => 0,
                                    ]]);
                                }
                            @endphp

                            @foreach($data as $i => $row)
                                <tr class="border-t even:bg-white odd:bg-gray-50">
                                    <td class="px-6 py-6 text-sm">{{ ($data->firstItem() ?? 0) + $i }}</td>
                                    @php
                                    $kode_wil = Crypt::encrypt($row->kode_wil);     
                                    @endphp
                                    <td class="px-6 py-6 text-sm text-blue-600"><a href="{{ URL::to('rombel/perKecamatan/' . $kode_wil) }}">{{ $row->induk_kecamatan  }}</a></td>
                                        <td class="px-6 py-6 text-sm text-center">{{ is_numeric($row->total ?? $row['total'] ?? null) ? ($row->total ?? $row['total']) : 0 }}</td>
                                        <td class="px-6 py-6 text-sm text-center">{{ is_numeric($row->tk ?? $row['tk'] ?? null) ? ($row->tk ?? $row['tk']) : 0 }}</td>
                                        <td class="px-6 py-6 text-sm text-center">{{ is_numeric($row->sd ?? $row['sd'] ?? null) ? ($row->sd ?? $row['sd']) : 0 }}</td>
                                        <td class="px-6 py-6 text-sm text-center">{{ is_numeric($row->smp ?? $row['smp'] ?? null) ? ($row->smp ?? $row['smp']) : 0 }}</td>
                                </tr>
                            @endforeach

                            {{-- Totals row --}}
                            <tr class="border-t bg-white font-semibold">
                                <td class="px-6 py-4">&nbsp;</td>
                                <td class="px-6 py-4">Total</td>
                                <td class="px-6 py-4 text-center">{{ $data->sum('total') ?? 0 }}</td>
                                <td class="px-6 py-4 text-center">{{ $data->sum('tk') ?? 0 }}</td>
                                <td class="px-6 py-4 text-center">{{ $data->sum('sd') ?? 0 }}</td>
                                <td class="px-6 py-4 text-center">{{ $data->sum('smp') ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <div class="flex justify-center items-center text-sm text-gray-600">
                        {{-- If $data is a paginator, show links; else show simple placeholder --}}
                        @if(method_exists($data,'links'))
                            {{ $data->links() }}
                        @else
                            <nav class="inline-flex -space-x-px" aria-label="Pagination">
                                <a class="px-3 py-1 bg-white border rounded-l text-gray-600">‹</a>
                                <a class="px-3 py-1 bg-indigo-50 border text-indigo-700 font-semibold">1</a>
                                <a class="px-3 py-1 bg-white border text-gray-600">2</a>
                                <span class="px-3 py-1">…</span>
                                <a class="px-3 py-1 bg-white border text-gray-600">›</a>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
