<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Pemeliharaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #1a202c;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #718096;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #f7fafc;
            color: #4a5568;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-right {
            text-align: right;
        }
        .status {
            font-weight: bold;
            text-transform: capitalize;
        }
        .status-planned { color: #3182ce; }
        .status-ongoing { color: #d69e2e; }
        .status-completed { color: #38a169; }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #a0aec0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEM MANAJEMEN SARANA PRASARANA</h1>
        <p>Laporan Riwayat Pemeliharaan Aset</p>
        <p style="font-size: 10px; margin-top: 5px;">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    @if(request('start_date') || request('end_date') || request('category_id') || request('status'))
        <div style="margin-bottom: 15px; font-size: 11px; background: #f7fafc; padding: 10px; border: 1px solid #e2e8f0;">
            <strong>Filter Aktif:</strong><br>
            @if(request('start_date')) Tanggal Mulai: {{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d M Y') }} <br> @endif
            @if(request('end_date')) Tanggal Selesai: {{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d M Y') }} <br> @endif
            @if(request('category_id')) Kategori Aset: {{ \App\Models\Category::find(request('category_id'))->name ?? '-' }} <br> @endif
            @if(request('status')) Status: {{ ucfirst(request('status')) }} <br> @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Aset</th>
                <th width="15%">Kategori</th>
                <th width="20%">Deskripsi</th>
                <th width="15%" class="text-right">Biaya (Rp)</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalCost = 0; @endphp
            @forelse($logs as $index => $log)
                @php $totalCost += $log->cost; @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->maintenance_date)->translatedFormat('d M Y') }}</td>
                    <td>{{ $log->asset->name }}</td>
                    <td>{{ $log->asset->category->name ?? '-' }}</td>
                    <td>{{ $log->description }}</td>
                    <td class="text-right">{{ number_format($log->cost, 0, ',', '.') }}</td>
                    <td class="status status-{{ strtolower($log->status) }}">{{ ucfirst($log->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">Data pemeliharaan tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Biaya Pemeliharaan</th>
                <th class="text-right">{{ number_format($totalCost, 0, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak oleh sistem pada {{ \Carbon\Carbon::now()->toDateTimeString() }}
    </div>
</body>
</html>
