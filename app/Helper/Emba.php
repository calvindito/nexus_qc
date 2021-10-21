<?php

namespace App\Helper;

use App\Models\SisterCompany;

class Emba {

    public static function treeViewWorkingHoursChart()
    {
            $sister_company = SisterCompany::where('status', 'Active')->get();
            $tree_view      = [];
            $branch         = [];

            foreach($sister_company as $sc) {
                if($sc->sisterBranch) {
                    foreach($sc->sisterBranch as $sb) {

                    }
                } else {
                    $tree_view[] = [
                        'code'   => $sc->code,
                        'name'   => $sc->nama,
                        'branch' => []
                    ];
                }
            }

            return $tree_view;
    }

}
