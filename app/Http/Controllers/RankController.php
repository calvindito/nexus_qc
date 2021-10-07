<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankController extends Controller {

    public function index()
    {
        $data = [
            'title'   => 'Master Data - Global - Rank',
            'content' => 'global.rank'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function datatable(Request $request)
    {
        $column = [
            'id',
            'rank',
            'description',
            'status'
        ];

        $start  = $request->start;
        $length = $request->length;
        $order  = $column[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $total_data = Rank::count();

        $query_data = Rank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('rank', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%");
                    });
                }
            })
            ->offset($start)
            ->limit($length)
            ->orderBy($order, $dir)
            ->get();

        $total_filtered = Rank::where(function($query) use ($search, $request) {
                if($search) {
                    $query->where(function($query) use ($search) {
                        $query->where('rank', 'like', "%$search%")
                            ->orWhere('description', 'like', "%$search%");
                    });
                }
            })
            ->count();

        $response['data'] = [];
        if($query_data <> FALSE) {
            foreach($query_data as $val) {
                $response['data'][] = [
                    $val->id,
                    $val->rank,
                    $val->description,
                    $val->status
                ];
            }
        }

        $response['recordsTotal'] = 0;
        if($total_data <> FALSE) {
            $response['recordsTotal'] = $total_data;
        }

        $response['recordsFiltered'] = 0;
        if($total_filtered <> FALSE) {
            $response['recordsFiltered'] = $total_filtered;
        }

        return response()->json($response);
    }

}
