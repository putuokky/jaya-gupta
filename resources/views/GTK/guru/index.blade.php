<x-layouts.app :title="__('Data Guru di Denpasar')">
    <header class="z-10 py-4 bg-white shadow-md">
        <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600">
            <h2 class="text-2xl font-semibold text-gray-700">Data Guru di Denpasar</h2>
        </div>
    </header>

    <div class="mx-auto px-6 py-6">
        <div class="bg-white rounded shadow overflow-hidden">
            <div class="p-4">
                <div class="bg-blue-300 rounded p-3 text-blue-900 flex items-center justify-between">
                    <div>Data Guru bersumber dari <code class="bg-white px-1 rounded text-red-600">dapo.kemdikbud.go.id</code></div>
                    <button class="text-white opacity-60 hover:opacity-100">✕</button>
                </div>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y table-auto" style="width:100%">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-sm text-gray-600">
                                <th rowspan="2" class="px-6 py-3">No</th>
                                <th rowspan="2" class="px-6 py-3">Wilayah</th>
                                <th colspan="3" class="px-6 py-3 text-center">Total</th>
                                <th colspan="3" class="px-6 py-3 text-center">TK</th>
                                <th colspan="3" class="px-6 py-3 text-center">SD</th>
                                <th colspan="3" class="px-6 py-3 text-center">SMP</th>
                            </tr>
                            <tr class="text-left text-sm text-gray-600 bg-gray-100">
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">L</th>
                                <th class="px-6 py-2 text-center">P</th>
                                
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">L</th>
                                <th class="px-6 py-2 text-center">P</th>
                                
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">L</th>
                                <th class="px-6 py-2 text-center">P</th>
                                
                                <th class="px-6 py-2 text-center">Jml</th>
                                <th class="px-6 py-2 text-center">L</th>
                                <th class="px-6 py-2 text-center">P</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @php
                                // fallback sample data if none provided
                                if(!isset($data) || (is_countable($data) && count($data) === 0)){
                                    $data = collect([ (object)[
                                        'wilayah' => 'Kec. Denpasar Timur',
                                        'total_guru' => 0,
                                    ]]);
                                }
                            @endphp

                            @foreach($data as $i => $row)
                                <tr class="border-t even:bg-white odd:bg-gray-50">
                                    <td class="px-6 py-3 text-sm">{{ $i }}</td>
                                    @php
                                    $kode_wil = isset($row->kode_wilayah_induk_kecamatan) ? Crypt::encrypt($row->kode_wilayah_induk_kecamatan) : null;
                                    @endphp
                                    <td class="px-6 py-3 text-sm text-blue-600">
                                       
                                            <a href="{{ URL::to('guru/perWilayah/' . $kode_wil) }}">{{ $row->induk_kecamatan ?? $row['induk_kecamatan'] ?? '-' }}</a>
                                      
                                    </td>
                                    
                                    {{-- Total columns - using total_guru as Jml --}}
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->jumlah_l + $row->jumlah_w }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->jumlah_l}}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->jumlah_w}}</td>
                                    
                                    {{-- TK columns --}}
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->tk_l+$row->tk_p }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{$row->tk_l }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{$row->tk_p }}</td>
                                    
                                    {{-- SD columns --}}
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->sd_l+$row->sd_p }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->sd_l }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->sd_p }}</td>
                                    
                                    {{-- SMP columns --}}
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->smp_l+$row->smp_p }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->smp_l }}</td>
                                    <td class="px-6 py-3 text-sm text-center">{{ $row->smp_p }}</td>
                                </tr>
                            @endforeach

                            {{-- Totals row --}}
                            <tr class="border-t bg-white font-semibold">
                                <td class="px-6 py-3">&nbsp;</td>
                                <td class="px-6 py-3">Total</td>
                                
                                <td class="px-6 py-3 text-center">{{ $data->sum('total_guru') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('total_guru_l') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('total_guru_p') ?? 0 }}</td>
                                
                                <td class="px-6 py-3 text-center">{{ $data->sum('tk_guru') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('tk_guru_l') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('tk_guru_p') ?? 0 }}</td>
                                
                                <td class="px-6 py-3 text-center">{{ $data->sum('sd_guru') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('sd_guru_l') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('sd_guru_p') ?? 0 }}</td>
                                
                                <td class="px-6 py-3 text-center">{{ $data->sum('smp_guru') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('smp_guru_l') ?? 0 }}</td>
                                <td class="px-6 py-3 text-center">{{ $data->sum('smp_guru_p') ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

             
        </div>
    </div>

</x-layouts.app>
