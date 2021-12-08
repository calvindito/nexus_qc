<?php

use App\Models\SisterCompany;

if(!function_exists('treeViewWorkingHoursChart')) {
    function treeViewWorkingHoursChart() {
        $tree_view      = [];
        $sister_company = SisterCompany::where('status', 'Active')->get();
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
                                                        'id'   => $l->id,
                                                        'name' => $l->name,
                                                        'sub'  => []
                                                    ];
                                                }

                                                $section[] = [
                                                    'id'   => $s->id,
                                                    'name' => $s->name,
                                                    'sub'  => $line
                                                ];
                                            } else {
                                                $section[] = [
                                                    'id'   => $s->id,
                                                    'name' => $s->name,
                                                    'sub'  => []
                                                ];
                                            }
                                        }

                                        $departement[] = [
                                            'id'   => $dtt->id,
                                            'name' => $dtt->department,
                                            'sub'  => $section
                                        ];
                                    } else {
                                        $departement[] = [
                                            'id'   => $dtt->id,
                                            'name' => $dtt->department,
                                            'sub'  => []
                                        ];
                                    }
                                }

                                $division[] = [
                                    'id'   => $d->id,
                                    'name' => $d->divisi,
                                    'sub'  => $departement
                                ];
                            } else {
                                $division[] = [
                                    'id'   => $d->id,
                                    'name' => $d->divisi,
                                    'sub'  => []
                                ];
                            }
                        }

                        $branch[] = [
                            'id'   => $sb->idsetupsisterbranch,
                            'name' => $sb->description,
                            'sub'  => $division
                        ];
                    } else {
                        $branch[] = [
                            'id'   => $sb->idsetupsisterbranch,
                            'name' => $sb->description,
                            'sub'  => []
                        ];
                    }
                }

                $tree_view[] = [
                    'id'   => $sc->id,
                    'name' => $sc->name,
                    'sub'  => $branch
                ];
            } else {
                $tree_view[] = [
                    'id'   => $sc->id,
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
