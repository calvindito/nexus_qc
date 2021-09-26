<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\Gender;
use App\Exports\SizeExport;
use App\Models\GroupDefect;
use App\Models\ProductType;
use App\Exports\BrandExport;
use App\Exports\BuyerExport;
use App\Exports\ColorExport;
use App\Models\ProductClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\FabricExport;
use App\Exports\GenderExport;
use App\Exports\GroupDefectExport;
use App\Exports\TypeProductExport;
use App\Exports\ProductClassExport;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {

    public function pdf($param)
    {
        $data = $this->mappingPdf($param);
        if(!$param || empty($data)) {
            abort(404);
        }

        $pdf  = PDF::loadView('pdf.' . $data['view'], [
            'title' => $data['title'],
            'data'  => $data['data']
        ], ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetAuthor(session('name'));
            $mpdf->SetProtection(['copy', 'print', 'extract', 'print-highres'], '', 'NexusPDF');
            $mpdf->SetWatermarkImage(public_path('website/logo-big.png'), 1, '', [160, 10]);
            $mpdf->showWatermarkImage  = true;
            $mpdf->watermarkImageAlpha = 0.1;
        }]);

        return $pdf->stream('QC - ' . $data['filename'] . ' - ' . date('Y_m_d_H_i_s') . '.pdf');
    }

    private function mappingPdf($param)
    {
        switch($param) {
            case 'gender':
                $response = [
                    'view'     => 'gender',
                    'title'    => 'Nexus - Data Gender',
                    'data'     => Gender::all(),
                    'filename' => 'Data Gender'
                ];
                break;
            case 'class_product':
                $response = [
                    'view'     => 'class_product',
                    'title'    => 'Nexus - Data Class Product',
                    'data'     => ProductClass::all(),
                    'filename' => 'Data Class Product'
                ];
                break;
            case 'group_size':
                $response = [
                    'view'     => 'group_size',
                    'title'    => 'Nexus - Data Group Size',
                    'data'     => Size::all(),
                    'filename' => 'Data Group Size'
                ];
                break;
            case 'type_product':
                $response = [
                    'view'     => 'type_product',
                    'title'    => 'Nexus - Data Type Product',
                    'data'     => ProductType::all(),
                    'filename' => 'Data Type Product'
                ];
                break;
            case 'brand':
                $response = [
                    'view'     => 'brand',
                    'title'    => 'Nexus - Data Brand',
                    'data'     => Brand::all(),
                    'filename' => 'Data Brand'
                ];
                break;
            case 'fabric':
                $response = [
                    'view'     => 'fabric',
                    'title'    => 'Nexus - Data Fabric',
                    'data'     => Fabric::all(),
                    'filename' => 'Data Fabric'
                ];
                break;
            case 'color':
                $response = [
                    'view'     => 'color',
                    'title'    => 'Nexus - Data Color',
                    'data'     => Color::all(),
                    'filename' => 'Data Color'
                ];
                break;
            case 'group_defect':
                $response = [
                    'view'     => 'group_defect',
                    'title'    => 'Nexus - Data Group Defect',
                    'data'     => GroupDefect::where('type', 1)->get(),
                    'filename' => 'Data Group Defect'
                ];
                break;
            case 'sub_group_defect':
                $response = [
                    'view'     => 'sub_group_defect',
                    'title'    => 'Nexus - Data Sub Group Defect',
                    'data'     => GroupDefect::where('type', 2)->get(),
                    'filename' => 'Data Sub Group Defect'
                ];
                break;
            case 'defect_list':
                $response = [
                    'view'     => 'defect_list',
                    'title'    => 'Nexus - Data Defect',
                    'data'     => GroupDefect::where('type', 3)->get(),
                    'filename' => 'Data Defect'
                ];
                break;
            case 'reject_list':
                $response = [
                    'view'     => 'reject_list',
                    'title'    => 'Nexus - Data Reject',
                    'data'     => GroupDefect::where('type', 4)->get(),
                    'filename' => 'Data Reject'
                ];
                break;
            case 'major_defect_list':
                $response = [
                    'view'     => 'major_defect_list',
                    'title'    => 'Nexus - Data Major Defect',
                    'data'     => GroupDefect::where('type', 5)->get(),
                    'filename' => 'Data Major Defect'
                ];
                break;
            case 'critical_defect_list':
                $response = [
                    'view'     => 'critical_defect_list',
                    'title'    => 'Nexus - Data Critical Defect',
                    'data'     => GroupDefect::where('type', 6)->get(),
                    'filename' => 'Data Critical Defect'
                ];
                break;
            default:
                $response = [];
                break;
        }

        return $response;
    }

    public function excel($param)
    {
        if(!$param) {
            abort(404);
        }

        switch($param) {
            case 'gender':
                return (new GenderExport)->download('QC - Data Gender - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'class_product':
                return (new ProductClassExport)->download('QC - Data Class Product - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'group_size':
                return (new SizeExport)->download('QC - Data Group Size - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'type_product':
                return (new TypeProductExport)->download('QC - Data Type Product - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'buyer':
                return (new BuyerExport)->download('QC - Data Buyer - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'brand':
                return (new BrandExport)->download('QC - Data Brand - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'fabric':
                return (new FabricExport)->download('QC - Data Fabric - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'color':
                return (new ColorExport)->download('QC - Data Color - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'group_defect':
                return (new GroupDefectExport(1))->download('QC - Data Group Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'sub_group_defect':
                return (new GroupDefectExport(2))->download('QC - Data Sub Group Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'defect_list':
                return (new GroupDefectExport(3))->download('QC - Data Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'reject_list':
                return (new GroupDefectExport(4))->download('QC - Data Reject - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'major_defect_list':
                return (new GroupDefectExport(5))->download('QC - Data Major Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'critical_defect_list':
                return (new GroupDefectExport(6))->download('QC - Data Critical Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            default:
                return redirect()->back();
                break;
        }
    }

}
