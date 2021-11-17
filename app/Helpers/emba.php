<?php

use App\Models\SisterCompany;

if(!function_exists('treeViewWorkingHoursChart')) {
    function treeViewWorkingHoursChart() {
        $sister_company = SisterCompany::where('status', 'Active')->get();
        $tree_view      = [];
        $branch         = [];
        $division       = [];
        $departement    = [];

        foreach($sister_company as $sc) {
            if($sc->sisterBranch) {
                foreach($sc->sisterBranch as $sb) {
                    if($sb->division) {
                        foreach($sb->division as $d) {
                            if($d->departement) {
                                foreach($d->departement as $dtt) {
                                    $departement[] = [
                                        'name' => $dtt->department,
                                        'sub'  => []
                                    ];
                                }

                                $division[] = [
                                    'name' => $d->divisi,
                                    'sub'  => $departement
                                ];
                            } else {
                                $division[] = [
                                    'name' => $d->divisi,
                                    'sub'  => []
                                ];
                            }
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

if(!function_exists('encodeString')) {
    function encodeString($value) {
        $key     = '4532879263570159';
        $secret  = '4987632563987124';
        $method  = 'aes-256-cbc';
        $encrypt = hash('sha256', $secret);
        $hash    = substr(hash('sha256', $key), 0, 16);
        $result  = openssl_encrypt($value, $method, $encrypt, 0, $hash);

        return base64_encode($result);
    }
}

if(!function_exists('decodeString')) {
    function decodeString($value) {
        $key     = '4532879263570159';
        $secret  = '4987632563987124';
        $method  = 'aes-256-cbc';
        $encrypt = hash('sha256', $secret);
        $hash    = substr(hash('sha256', $key), 0, 16);
        $result  = openssl_decrypt(base64_decode($value), $method, $encrypt, 0, $hash);

        return $result;
    }
}
