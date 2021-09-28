<?php

namespace App\Imports;

use App\Models\ProductType;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TypeProductImport implements ToCollection, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError {

    use Importable, SkipsFailures, SkipsErrors;

    public function collection(Collection $rows)
    {
        foreach($rows as $r) {
            ProductType::create([
                'product_class_id' => $r['class_product_id'],
                'gender_id'        => $r['gender_id'],
                'size_id'          => $r['group_size_id'],
                'created_by'       => session('id'),
                'updated_by'       => session('id'),
                'name'             => $r['type_product'],
                'smv_global'       => $r['smv_global'],
                'description'      => $r['description'],
                'status'           => 1
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'class_product_id' => ['required', 'integer'],
            'gender_id'        => ['required', 'integer'],
            'group_size_id'    => ['required', 'integer'],
            'type_product'     => ['required', 'string'],
            'smv_global'       => ['required', 'string']
        ];
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
