<?php

namespace App\Imports;

use App\Imports\BuyerDataImport;
use App\Imports\BuyerContactImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BuyerImport implements WithMultipleSheets, SkipsUnknownSheets {

    public function sheets(): array
    {
        return [
            'Data'    => new BuyerDataImport(),
            'Contact' => new BuyerContactImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }

}
