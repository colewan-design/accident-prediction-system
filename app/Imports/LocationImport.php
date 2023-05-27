<?php

namespace App\Imports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithProperties;

class LocationImport implements WithChunkReading, WithMultipleSheets, WithProgressBar, SkipsOnFailure
{
    use Importable, SkipsFailures, WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Sheet1' => new FirstSheetImport(),
        ];
    } 

    public function chunkSize(): int
    {
        return 1000;
    }
}
