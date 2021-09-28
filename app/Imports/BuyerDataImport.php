<?php

namespace App\Imports;

use App\Models\Buyer;
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

class BuyerDataImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError {

    use Importable, SkipsFailures, SkipsErrors;

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            'country_id.*'     => 'required|integer',
            'province_id.*'    => 'required|integer',
            'city_id.*'        => 'required|integer',
            'departement_id.*' => 'required|integer',
            'marker.*'         => 'required',
            'company.*'        => 'required',
            'remark.*'         => 'required',
            'address.*'        => 'required'
        ], [
            'country_id.*.required'     => 'Country ID cannot be empty',
            'country_id.*.integer'      => 'Country ID must be number',
            'province_id.*.required'    => 'Province ID cannot be empty',
            'province_id.*.integer'     => 'Province ID must be number',
            'city_id.*.required'        => 'City ID cannot be empty',
            'city_id.*.integer'         => 'City ID must be number',
            'departement_id.*.required' => 'Departement ID cannot be empty',
            'departement_id.*.integer'  => 'Departement ID must be number',
            'marker.*.required'         => 'Marker cannot be empty',
            'company.*.required'        => 'Company cannot be empty',
            'remark.*.required'         => 'Remark cannot be empty',
            'address.*.required'        => 'Address cannot be empty'
        ])->validate();

        foreach($rows as $r) {
            Buyer::create([
                'country_id'     => $r['country_id'],
                'province_id'    => $r['province_id'],
                'city_id'        => $r['city_id'],
                'departement_id' => $r['departement_id'],
                'created_by'     => session('id'),
                'updated_by'     => session('id'),
                'excelable'      => $r['marker'],
                'company'        => $r['company'],
                'description'    => $r['description'],
                'remark'         => $r['remark'],
                'address'        => $r['address'],
                'status'         => 1
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
