<?php

namespace App\Imports;

use App\Models\Buyer;
use App\Models\BuyerContact;
use Illuminate\Validation\Rule;
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

class BuyerContactImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError {

    use Importable, SkipsFailures, SkipsErrors;

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            'buyer_id.*' => 'required|integer',
            'rank_id.*'  => 'required|integer',
            'name.*'     => 'required',
            'value.*'    => 'required',
            'type.*'     => ['required', Rule::in(['office', 'hp', 'fax', 'email'])]
        ], [
            'buyer_id.*.required' => 'Buyer ID cannot be empty',
            'buyer_id.*.integer'  => 'Buyer ID must be number',
            'rank_id.*.required'  => 'Rank ID cannot be empty',
            'rank_id.*.integer'   => 'Rank ID must be number',
            'name.*.required'     => 'Name cannot be empty',
            'value.*.required'    => 'Value cannot be empty',
            'type.*.required'     => 'Type cannot be empty',
            'type.*.in'           => 'The choice of type is only office, hp, fax, email'
        ])->validate();

        foreach($rows as $r) {
            $buyer = Buyer::where('excelable', $r['marker'])->first();
            if($buyer) {
                switch($r['type']) {
                    case 'office':
                        $type = 1;
                        break;
                    case 'hp':
                        $type = 2;
                        break;
                    case 'fax':
                        $type = 3;
                        break;
                    case 'email':
                        $type = 4;
                        break;
                    default:
                        $type = 0;
                        break;
                }

                BuyerContact::create([
                    'buyer_id' => $buyer->id,
                    'rank_id'  => $r['rank_id'],
                    'name'     => $r['name'],
                    'value'    => $r['value'],
                    'type'     => $type
                ]);
            }
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
