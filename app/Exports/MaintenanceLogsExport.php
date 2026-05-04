<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaintenanceLogsExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function view(): View
    {
        return view('admin.maintenance.excel', [
            'logs' => $this->logs
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
