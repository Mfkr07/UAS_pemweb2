<table>
    <thead>
        <tr>
            <th colspan="7" style="font-weight: bold; text-align: center; font-size: 14px;">Laporan Riwayat Pemeliharaan Aset</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center;">Diekspor pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</th>
        </tr>
        @if(request('start_date') || request('end_date') || request('category_id') || request('status'))
            <tr>
                <th colspan="7">
                    Filter: 
                    @if(request('start_date')) Mulai {{ request('start_date') }} @endif
                    @if(request('end_date')) - Selesai {{ request('end_date') }} @endif
                    @if(request('category_id')) | Kategori ID: {{ request('category_id') }} @endif
                    @if(request('status')) | Status: {{ request('status') }} @endif
                </th>
            </tr>
        @endif
        <tr>
            <th colspan="7"></th>
        </tr>
        <tr>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 50px;">No</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 120px;">Tanggal</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 250px;">Nama Aset</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 150px;">Kategori</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 300px;">Deskripsi</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 150px;">Biaya (Rp)</th>
            <th style="font-weight: bold; border: 1px solid #000000; background-color: #f3f4f6; width: 100px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @php $totalCost = 0; @endphp
        @foreach($logs as $index => $log)
            @php $totalCost += $log->cost; @endphp
            <tr>
                <td style="border: 1px solid #000000;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ \Carbon\Carbon::parse($log->maintenance_date)->format('Y-m-d') }}</td>
                <td style="border: 1px solid #000000;">{{ $log->asset->name }}</td>
                <td style="border: 1px solid #000000;">{{ $log->asset->category->name ?? '-' }}</td>
                <td style="border: 1px solid #000000;">{{ $log->description }}</td>
                <td style="border: 1px solid #000000;">{{ $log->cost }}</td>
                <td style="border: 1px solid #000000;">{{ ucfirst($log->status) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5" style="font-weight: bold; text-align: right; border: 1px solid #000000;">Total Biaya Pemeliharaan</th>
            <th style="font-weight: bold; border: 1px solid #000000;">{{ $totalCost }}</th>
            <th style="border: 1px solid #000000;"></th>
        </tr>
    </tfoot>
</table>
