<?php

use App\Models\SisterCompany;

if(!function_exists('treeViewWorkingHoursChart')) {
    function treeViewWorkingHoursChart() {
        $sister_company = SisterCompany::where('status', 'Active')->get();
        $tree_view      = [];
        $branch         = [];
        $division       = [];
        $departement    = [];
        $section        = [];
        $line           = [];

        foreach($sister_company as $sc) {
            if($sc->sisterBranch->count() > 0) {
                foreach($sc->sisterBranch as $sb) {
                    if($sb->division->count() > 0) {
                        foreach($sb->division as $d) {
                            if($d->departement->count() > 0) {
                                foreach($d->departement as $dtt) {
                                    if($dtt->section->count() > 0) {
                                        foreach($dtt->section as $s) {
                                            if($s->line->count() > 0) {
                                                foreach($s->line as $l) {
                                                    $line[] = [
                                                        'name' => $l->name,
                                                        'sub'  => []
                                                    ];
                                                }

                                                $section[] = [
                                                    'name' => $s->name,
                                                    'sub'  => $line
                                                ];
                                            } else {
                                                $section[] = [
                                                    'name' => $s->name,
                                                    'sub'  => []
                                                ];
                                            }
                                        }

                                        $departement[] = [
                                            'name' => $dtt->department,
                                            'sub'  => $section
                                        ];
                                    } else {
                                        $departement[] = [
                                            'name' => $dtt->department,
                                            'sub'  => []
                                        ];
                                    }
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

        // dd($tree_view);

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
