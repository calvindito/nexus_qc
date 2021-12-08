<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Line;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\Style;
use App\Models\Fabric;
use App\Models\Gender;
use App\Models\JobDesc;
use App\Models\Section;
use App\Models\Position;
use App\Exports\LineExport;
use App\Exports\SizeExport;
use App\Models\GroupDefect;
use App\Models\ProductType;
use App\Exports\BrandExport;
use App\Exports\BuyerExport;
use App\Exports\ColorExport;
use App\Exports\StyleExport;
use App\Models\ProductClass;
use App\Models\ProductGroup;
use Maatwebsite\Excel\Excel;
use App\Exports\FabricExport;
use App\Exports\GenderExport;
use App\Exports\JobDescExport;
use App\Exports\SectionExport;
use App\Exports\PositionExport;
use App\Exports\GroupDefectExport;
use App\Exports\TypeProductExport;
use App\Exports\ProductClassExport;
use App\Exports\ProductGroupExport;
use App\Http\Controllers\Controller;

class DownloadController extends Controller {

    public function pdf($param)
    {
        $data = $this->mappingPdf($param);
        if(!$param || empty($data)) {
            abort(404);
        }

        $pdf = PDF::loadView('pdf.' . $data['view'], [
            'title' => $data['title'],
            'data'  => $data['data']
        ], ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetAuthor(session('name'));
            $mpdf->SetProtection(['copy', 'print', 'extract', 'print-highres'], '', 'NexusPDF');
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

                activity('gender')
                    ->performedOn(new Gender())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'class_product':
                $response = [
                    'view'     => 'class_product',
                    'title'    => 'Nexus - Data Class Product',
                    'data'     => ProductClass::all(),
                    'filename' => 'Data Class Product'
                ];

                activity('class product')
                    ->performedOn(new ProductClass())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'size':
                $response = [
                    'view'     => 'size',
                    'title'    => 'Nexus - Data Size',
                    'data'     => Size::all(),
                    'filename' => 'Data Size'
                ];

                activity('size')
                    ->performedOn(new Size())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'type_product':
                $response = [
                    'view'     => 'type_product',
                    'title'    => 'Nexus - Data Type Product',
                    'data'     => ProductType::all(),
                    'filename' => 'Data Type Product'
                ];

                activity('type product')
                    ->performedOn(new ProductType())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'brand':
                $response = [
                    'view'     => 'brand',
                    'title'    => 'Nexus - Data Brand',
                    'data'     => Brand::all(),
                    'filename' => 'Data Brand'
                ];

                activity('brand')
                    ->performedOn(new Brand())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'fabric':
                $response = [
                    'view'     => 'fabric',
                    'title'    => 'Nexus - Data Fabric',
                    'data'     => Fabric::all(),
                    'filename' => 'Data Fabric'
                ];

                activity('fabric')
                    ->performedOn(new Fabric())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'color':
                $response = [
                    'view'     => 'color',
                    'title'    => 'Nexus - Data Color',
                    'data'     => Color::all(),
                    'filename' => 'Data Color'
                ];

                activity('color')
                    ->performedOn(new Color())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'group_defect':
                $response = [
                    'view'     => 'group_defect',
                    'title'    => 'Nexus - Data Group Defect',
                    'data'     => GroupDefect::where('type', 1)->get(),
                    'filename' => 'Data Group Defect'
                ];

                activity('group defect')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'defect_list':
                $response = [
                    'view'     => 'defect_list',
                    'title'    => 'Nexus - Data Defect',
                    'data'     => GroupDefect::where('type', 2)->get(),
                    'filename' => 'Data Defect'
                ];

                activity('defect list')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'reject_list':
                $response = [
                    'view'     => 'reject_list',
                    'title'    => 'Nexus - Data Reject',
                    'data'     => GroupDefect::where('type', 3)->get(),
                    'filename' => 'Data Reject'
                ];

                activity('reject list')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'major_issues':
                $response = [
                    'view'     => 'major_issues',
                    'title'    => 'Nexus - Data Major Issues',
                    'data'     => GroupDefect::where('type', 4)->get(),
                    'filename' => 'Data Major Issues'
                ];

                activity('major issues')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'critical_issues':
                $response = [
                    'view'     => 'critical_issues',
                    'title'    => 'Nexus - Data Critical Issues',
                    'data'     => GroupDefect::where('type', 5)->get(),
                    'filename' => 'Data Critical Issues'
                ];

                activity('critical issues')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'job_desc':
                $response = [
                    'view'     => 'job_desc',
                    'title'    => 'Nexus - Data Job Desc',
                    'data'     => JobDesc::all(),
                    'filename' => 'Data Job Desc'
                ];

                activity('job desc')
                    ->performedOn(new JobDesc())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'style':
                $response = [
                    'view'     => 'style',
                    'title'    => 'Nexus - Data Style',
                    'data'     => Style::all(),
                    'filename' => 'Data Style'
                ];

                activity('style')
                    ->performedOn(new Style())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'position':
                $response = [
                    'view'     => 'position',
                    'title'    => 'Nexus - Data Position',
                    'data'     => Position::all(),
                    'filename' => 'Data Position'
                ];

                activity('position')
                    ->performedOn(new Position())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'group_product':
                $response = [
                    'view'     => 'group_product',
                    'title'    => 'Nexus - Data Group Product',
                    'data'     => ProductGroup::all(),
                    'filename' => 'Data Group Product'
                ];

                activity('group product')
                    ->performedOn(new ProductGroup())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'section':
                $response = [
                    'view'     => 'section',
                    'title'    => 'Nexus - Data Section',
                    'data'     => Section::all(),
                    'filename' => 'Data Section'
                ];

                activity('section')
                    ->performedOn(new Section())
                    ->causedBy(session('id'))
                    ->log('view print');

                break;
            case 'line':
                $response = [
                    'view'     => 'line',
                    'title'    => 'Nexus - Data Line',
                    'data'     => Line::all(),
                    'filename' => 'Data Line'
                ];

                activity('line')
                    ->performedOn(new Line())
                    ->causedBy(session('id'))
                    ->log('view print');

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
                activity('gender')
                    ->performedOn(new Gender())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GenderExport)->download('QC - Data Gender - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'class_product':
                activity('class product')
                    ->performedOn(new ProductClass())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new ProductClassExport)->download('QC - Data Class Product - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'size':
                activity('size')
                    ->performedOn(new Size())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new SizeExport)->download('QC - Data Size - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'type_product':
                activity('type product')
                    ->performedOn(new ProductType())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new TypeProductExport)->download('QC - Data Type Product - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'buyer':
                activity('buyer')
                    ->performedOn(new Buyer())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new BuyerExport)->download('QC - Data Buyer - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'brand':
                activity('brand')
                    ->performedOn(new Brand())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new BrandExport)->download('QC - Data Brand - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'fabric':
                activity('fabric')
                    ->performedOn(new Fabric())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new FabricExport)->download('QC - Data Fabric - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'color':
                activity('color')
                    ->performedOn(new Color())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new ColorExport)->download('QC - Data Color - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'group_defect':
                activity('group defect')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GroupDefectExport(1))->download('QC - Data Group Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'defect_list':
                activity('defect list')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GroupDefectExport(2))->download('QC - Data Defect - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'reject_list':
                activity('reject list')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GroupDefectExport(3))->download('QC - Data Reject - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'major_issues':
                activity('major issues')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GroupDefectExport(4))->download('QC - Data Major Issues - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'critical_issues':
                activity('critical issues')
                    ->performedOn(new GroupDefect())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new GroupDefectExport(5))->download('QC - Data Critical Issues - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'job_desc':
                activity('job desc')
                    ->performedOn(new JobDesc())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new JobDescExport)->download('QC - Data Job Desc - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'style':
                activity('style')
                    ->performedOn(new Style())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new StyleExport)->download('QC - Data Style - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'position':
                activity('position')
                    ->performedOn(new Position())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new PositionExport)->download('QC - Data Position - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'group_product':
                activity('group product')
                    ->performedOn(new ProductGroup())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new ProductGroupExport)->download('QC - Data Group Product - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'section':
                activity('section')
                    ->performedOn(new Section())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new SectionExport)->download('QC - Data Section - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            case 'line':
                activity('line')
                    ->performedOn(new Line())
                    ->causedBy(session('id'))
                    ->log('download excel');

                return (new LineExport)->download('QC - Data Line - ' . date('Y_m_d_H_i_s') . '.xlsx', Excel::XLSX);
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    public function excelTemplate($param)
    {
        switch($param) {
            case 'type_product':
                activity('type product')
                    ->performedOn(new ProductType())
                    ->causedBy(session('id'))
                    ->log('download template excel');

                return response()->download(public_path('website/Template QC - Type Product.xlsx'));
                break;
            case 'buyer':
                activity('buyer')
                    ->performedOn(new Buyer())
                    ->causedBy(session('id'))
                    ->log('download template excel');

                return response()->download(public_path('website/Template QC - Buyer.xlsx'));
                break;
            case 'position':
                activity('position')
                    ->performedOn(new Position())
                    ->causedBy(session('id'))
                    ->log('download template excel');

                return response()->download(public_path('website/Template QC - Position.xlsx'));
                break;
            default:
                return redirect()->back();
                break;
        }
    }

}
