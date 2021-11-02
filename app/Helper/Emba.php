<?php

namespace App\Helper;

use App\Models\SisterCompany;

class Emba {

    public static function treeViewWorkingHoursChart()
    {
        $sister_company = SisterCompany::where('status', 'Active')->get();
        $tree_view      = [];
        $branch         = [];
        $division       = [];

        foreach($sister_company as $sc) {
            if($sc->sisterBranch) {
                foreach($sc->sisterBranch as $sb) {
                    if($sb->division) {
                        foreach($sb->division as $d) {
                            $division[] = [
                                'name' => $d->divisi,
                                'sub'  => []
                            ];
                        }

                        $branch[] = [
                            'name' => $sb->description,
                            'sub'  => $division
                        ];
                    } else {
                        $branch[] = [
                            'name' => $sb->description,
                            'sub'  => []
                        ];
                    }
                }

                $tree_view[] = [
                    'name' => $sc->name,
                    'sub'  => $branch
                ];
            } else {
                $tree_view[] = [
                    'name' => $sc->name,
                    'sub'  => []
                ];
            }
        }

        return $tree_view;
    }

}
