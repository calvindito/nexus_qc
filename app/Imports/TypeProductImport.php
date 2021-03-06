<?php

namespace App\Imports;

use App\Models\ProductType;
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

class TypeProductImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError {

    use Importable, SkipsFailures, SkipsErrors;

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            'group_id.*'         => 'required|integer',
            'type_product.*'     => 'required|string',
            'smv_global.*'       => 'required|string'
        ], [
            'group_id.*.required'         => 'Group ID cannot be empty',
            'group_id.*.integer'          => 'Group ID must be number',
            'type_product.*.required'     => 'Type product cannot be empty',
            'smv_global.*.required'       => 'Smv global cannot be empty'
        ])->validate();

        foreach($rows as $r) {
            ProductType::create([
                'product_group_id' => str_replace('0', '', $r['group_id']),
                'created_by'       => session('id'),
                'updated_by'       => session('id'),
                'name'             => $r['type_product'],
                'smv_global'       => $r['smv_global'],
                'description'      => $r['description'],
                'status'           => 1
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
