<?php

namespace App\Imports;

use App\Models\Position;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PositionImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError {

    use Importable, SkipsFailures, SkipsErrors;

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            'name.*' => 'required|string'
        ], [
            'name.*.required' => 'Position cannot be empty'
        ])->validate();

        foreach($rows as $r) {
            Position::create([
                'created_by' => session('id'),
                'updated_by' => session('id'),
                'name'       => $r['position'],
                'status'     => 1
            ]);
        }
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

}
