<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller {

    public function index($param)
    {
        $data = $this->mapping($param);
        if(!$param || empty($data)) {
            abort(404);
        }

        $pdf  = PDF::loadView('pdf.' . $data['view'], [
            'title' => $data['title'],
            'data'  => $data['data']
        ]);

        return $pdf->stream('QC - ' . $data['filename'] . ' - ' . date('Y_m_d_H_i_s') . '.pdf');
    }

    private function mapping($param)
    {
        switch($param) {
            case 'gender':
                $response = [
                    'view'     => 'gender',
                    'title'    => 'Pdf Gender',
                    'data'     => Gender::all(),
                    'filename' => 'Data Gender'
                ];
                break;
            default:
                $response = [];
                break;
        }

        return $response;
    }

}
